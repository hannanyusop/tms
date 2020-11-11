<?php
 namespace App\Http\Controllers\Frontend\User\Lorry;

 use App\Http\Controllers\Controller;
 use App\Models\Lorry;
 use App\Models\LorryRepair;
 use App\Models\RepairItem;
 use Illuminate\Http\Request;


 class RepairController extends Controller{

     public function create($lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         return view('frontend.user.lorry.repair.create', compact('lorry'));

     }

     public function insert(Request $request, $lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         $validate = $request->validate([
             'payment_method' => '',
             'payment_reference' => '',
             'payment_recepit' => '',
             'amount' => '',
             'remark' => '',
             'documents' => '',
         ]);

         $repair = new LorryRepair();

         $repair->lorry_id = $lorry->id;
         $repair->payment_method = $request->payment_method;
         $repair->payment_reference = $request->payment_reference;
         $repair->payment_recepit = $request->payment_recepit;
         $repair->amount = 0.00;
         $repair->remark = $request->remark;
         $repair->documents = $request->documents; #TODO: upload
         $repair->save();


         $amount = $repair->amount;

         foreach ($request->items as $item){

             $item = new RepairItem();
             $item->lorry_repair_id = $repair->id;
             $item->name = $item['name'];
             $item->remark = $item['remark'];
             $item->qty = $item['qty'];
             $item->total_price = $item['total_price'];

             if($item->save()){
                 $amount += $item->total_price;
             }
         }


         $repair->update(['amount' => $amount]);
         insertTransaction($repair->lorry_id, $repair->id, 'repair', '', 0.00, $amount);

         return redirect()->route('frontend.user.lorry.view', $lorry->id)->withFlashSuccess('Repair record inserted!');

     }

     public function edit($id){

         $repair = LorryRepair::findOrFail($id);

         return view('frontend.user.lorry.repair.edit', compact('repair'));

     }

     public function update(Request $request, $id){

         $repair = LorryRepair::findOrFail($id);

         $validate = $request->validate([
             'payment_method' => '',
             'payment_reference' => '',
             'payment_recepit' => '',
             'amount' => '',
             'remark' => '',
             'documents' => '',
         ]);

         foreach ($request->items as $key => $data){

             $item = RepairItem::where('service_id', $repair->id)
                 ->where('id', $id)
                 ->first();

             if($item){
                 $item->lorry_repair_id = $repair->id;
                 $item->name = $item['name'];
                 $item->remark = $item['remark'];
                 $item->qty = $item['qty'];
                 $item->total_price = $item['total_price'];
                 $item->save();
             }
         }

         $repair->payment_method = $request->payment_method;
         $repair->payment_reference = $request->payment_reference;
         $repair->payment_recepit = $request->payment_recepit;
         $repair->amount = RepairItem::where('repair_id', $repair->id)->sum('total_price');
         $repair->remark = $request->remark;
         $repair->documents = $request->documents; #TODO: upload
         $repair->save();

         updateTransaction($repair->lorry_id, 'repair', $repair->id,'', 0.00, $repair->amount);
         return redirect()->route('frontend.user.lorry.view', $request->lorry_id)->withFlashSuccess('Repair & Maintenance record updated!');
     }

     public function delete($id){

         $repair = LorryRepair::findOrFail($id);

         if($repair->delete()){
             deleteTransaction($repair->lorry_id, 'service', $repair->id);
         }

         return true;
     }
 }
