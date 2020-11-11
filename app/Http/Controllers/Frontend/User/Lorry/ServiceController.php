<?php
 namespace App\Http\Controllers\Frontend\User\Lorry;

 use App\Http\Controllers\Controller;
 use App\Models\Lorry;
 use App\Models\LorryService;
 use App\Models\ServiceItem;
 use Illuminate\Http\Request;

 class ServiceController extends Controller{

     public function create($lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         return view('frontend.user.lorry.service.create', compact('lorry'));

     }

     public function insert(Request $request, $lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         $validate = $request->validate([
             'next_service' => 'required',
             'mileage' => '',
             'mileage_next_service' => '',
             'amount' => '',
             'payment_method' => '',
             'payment_reference' => '',
             'payment_documents' => '',
             'remark' => ''
         ]);


         $service = new LorryService();
         $service->lorry_id = $lorry->id;
         $service->next_service = $request->next_service;
         $service->is_read = 0;
         $service->mileage = $request->mileage;
         $service->mileage_next_service = $request->mileage_next_service;
         $service->amount = 0.00;
         $service->payment_method = $request->payment_method;
         $service->payment_reference = $request->payment_reference;
         $service->payment_documents = $request->payment_documents; #upload
         $service->remark = $request->remark;

         $service->save();


         $amount = $service->amount;
         foreach ($request->items as $data){

             $item = new ServiceItem();
             $item->lorry_service_id = $service->id;
             $item->name = $data->name;
             $item->remark = $data->remark;
             $item->qty = $data->qty;
             $item->total_price = $data->total_price;

             if($item->save()){
                 $amount += $item->total_price;
             }
         }

         $service->update(['amount' => $amount]);
         insertTransaction($service->lorry_id, $service->id, 'service', null, 0.00, $amount);

         return redirect()->route('frontend.user.lorry.view', $lorry->id)->withFlashSuccess('Service record inserted!');

     }

     public function edit($id){

         $service = LorryService::findOrFail($id);

         return view('frontend.user.lorry.service.edit', compact('service'));

     }

     public function update(Request $request, $id){

         $service = LorryService::findOrFail($id);

         $validate = $request->validate([
             'next_service' => 'required',
             'mileage' => '',
             'mileage_next_service' => '',
             'amount' => '',
             'payment_method' => '',
             'payment_reference' => '',
             'payment_documents' => '',
             'remark' => ''
         ]);

         foreach ($request->items as $key => $data){

             $item = ServiceItem::where('service_id', $service->id)
                 ->where('id', $id)
                 ->first();

             if($item){
                 $item->name = $data->name;
                 $item->remark = $data->remark;
                 $item->qty = $data->qty;
                 $item->total_price = $data->total_price;
                 $item->save();
             }
         }

         $service->next_service = $request->next_service;
         $service->is_read = 0;
         $service->mileage = $request->mileage;
         $service->mileage_next_service = $request->mileage_next_service;
         $service->amount = ServiceItem::where('service_id', $service->id)->sum('total_price');
         $service->payment_method = $request->payment_method;
         $service->payment_reference = $request->payment_reference;
         $service->payment_documents = $request->payment_documents; #upload
         $service->remark = $request->remark;

         $service->save();

         updateTransaction($service->lorry_id, 'service', $service->id,'', 0.00, $service->amount);
         return redirect()->route('frontend.user.lorry.view', $service->lorry_id)->withFlashSuccess('Service record updated!');

     }

     public function delete($id){

         $service = LorryService::findOrFail($id);

         if($service->delete()){
             deleteTransaction($service->lorry_id, 'service', $service->id);
         }

         return true;
     }
 }
