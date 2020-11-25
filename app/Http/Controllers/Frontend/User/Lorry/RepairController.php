<?php
 namespace App\Http\Controllers\Frontend\User\Lorry;

 use App\Http\Controllers\Controller;
 use App\Models\Lorry;
 use App\Models\LorryRepair;
 use App\Models\RepairItem;
 use Illuminate\Http\Request;


 class RepairController extends Controller{

     public function index(){

         $repairs = LorryRepair::orderBy('id', 'DESC')->get();

         return view('frontend.user.lorry.repair.index', compact('repairs'));
     }

     public function view($id){

         $repair = LorryRepair::findOrFail($id);

         return view('frontend.user.lorry.repair.view', compact('repair'));
     }

     public function create($lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         return view('frontend.user.lorry.repair.create', compact('lorry'));

     }

     public function insert(Request $request, $lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         $validate = $request->validate([
             'payment_method' => 'required',
             'payment_reference' => 'required',
             'payment_documents' => 'nullable|file|max:5000',
             'amount' => '',
             'remark' => '',
             'documents' => '',
         ]);

         $repair = new LorryRepair();

         $repair->lorry_id = $lorry->id;
         $repair->payment_method = $request->payment_method;
         $repair->payment_reference = $request->payment_reference;
         $repair->payment_documents = $request->payment_documents;
         $repair->amount = 0.00;
         $repair->remark = $request->remark;
         $repair->documents = $request->documents; #TODO: upload
         $repair->save();


         $amount = $repair->amount;

         foreach ($request->name as $key => $item){

             $item = new RepairItem();
             $item->lorry_repair_id = $repair->id;
             $item->name = $request->name[$key];
             $item->description = $request->description[$key];
             $item->qty = $request->qty[$key];
             $item->total_price = $request->price[$key]*$request->qty[$key];

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

         $repair->payment_method = $request->payment_method;
         $repair->payment_reference = $request->payment_reference;
         $repair->payment_recepit = $request->payment_recepit;
         $repair->remark = $request->remark;
         $repair->documents = $request->documents; #TODO: upload
         $repair->save();

         return redirect()->route('frontend.user.lorry.view', $request->lorry_id)->withFlashSuccess('Repair record updated!');
     }

     public function insertItem(Request $request, $id){

         $request->validate([
             'name' => 'required|max:50',
             'description' => 'max:2000',
             'qty' => 'required|numeric|min:1',
             'price' => 'required|numeric|min:0',
         ]);

         $item = new RepairItem();
         $item->lorry_repair_id = $id;
         $item->name = $request->name;
         $item->description = $request->description;
         $item->qty = $request->qty;
         $item->total_price = $request->price*$request->qty;
         $item->save();

         $repair_amount = RepairItem::where('lorry_repair_id', $id)->sum('total_price');
         $item->repair->update(['amount' => $repair_amount]);
         updateTransaction($item->repair->lorry_id, 'repair', $item->repair->id,'', 0.00, $repair_amount);

         return redirect()->route('frontend.user.lorry.repair.edit', $id)->withFlashSuccess('Repair item inserted!');
     }

     public function updateItem(Request $request, $id, $item_id){

         $item = RepairItem::where([
             'lorry_repair_id' => $id,
             'id' => $item_id
         ])->firstOrFail();

         $request->validate([
             'name' => 'required|max:50',
             'description' => 'max:2000',
             'qty' => 'required|numeric|min:1',
             'price' => 'required|numeric|min:0',
         ]);

         $item->name = $request->name;
         $item->description = $request->description;
         $item->qty = $request->qty;
         $item->total_price = $request->price*$request->qty;
         $item->save();

         $repair_amount = RepairItem::where('lorry_repair_id', $id)->sum('total_price');
         $item->repair->update(['amount' => $repair_amount]);
         updateTransaction($item->repair->lorry_id, 'repair', $item->repair->id,'', 0.00, $repair_amount);

         return redirect()->route('frontend.user.lorry.repair.edit', $id)->withFlashSuccess('Repair item updated!');

     }

     public function deleteItem($id, $item_id){

         $item = RepairItem::where([
             'lorry_repair_id' => $id,
             'id' => $item_id
         ])->firstOrFail();


         if($item->delete()){
             $repair_amount = RepairItem::where('lorry_repair_id', $id)->sum('total_price');

             $item->repair->update(['amount' => $repair_amount]);

             updateTransaction($item->repair->lorry_id, 'repair', $item->repair->id,'', 0.00, $repair_amount);

             return redirect()->route('frontend.user.lorry.repair.edit', $id)->withFlashSuccess('Item removed from list!');
         }else{

             return redirect()->route('frontend.user.lorry.repair.edit', $id)->withFlashError('Failed to removed item from list!');
         }


     }

     public function delete(Request  $request, $id){

         if($request->ajax()){

             $repair = LorryRepair::findOrFail($id);

             if($repair->delete()){
                 RepairItem::where('lorry_repair_id', $repair->id)->delete();
                 deleteTransaction($repair->lorry_id, 'repair', $repair->id);
                 return response()->json(['success' => true, 'message' => "Repair & Maintenance record deleted!"]);
             }else{

                 return response()->json(['success' => true, 'message' => "Failed to delete Repair & Maintenance record!"]);
             }
         }else{
             return response()->json(['error' => false, 'message' => "Invalid method!"]);
         }

     }
 }
