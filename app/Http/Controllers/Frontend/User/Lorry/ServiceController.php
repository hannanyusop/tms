<?php
 namespace App\Http\Controllers\Frontend\User\Lorry;

 use App\Http\Controllers\Controller;
 use App\Models\Lorry;
 use App\Models\LorryService;
 use App\Models\ServiceItem;
 use Carbon\Carbon;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Date;

 class ServiceController extends Controller{

     public function create($lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         return view('frontend.user.lorry.service.create', compact('lorry'));

     }

     public function insert(Request $request, $lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         $request->validate([
             'next_service' => 'required|date',
             'mileage' => 'required|numeric|min:0',
             'mileage_next_service' => 'required|numeric|min:0',
             'payment_method' => 'required',
             'payment_reference' => 'required',
             'payment_documents' => 'nullable|file|max:5000',
             'remark' => 'max:2000'
         ]);

         $service = new LorryService();
         $service->lorry_id = $lorry->id;
         $service->next_service = Carbon::create($request->next_service);
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

         foreach ($request->name as $key => $item){

             $item = new ServiceItem();
             $item->lorry_service_id = $service->id;
             $item->name = $request->name[$key];
             $item->description = $request->description[$key];
             $item->qty = $request->qty[$key];
             $item->total_price = $request->price[$key]*$request->qty[$key];

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

         $request->validate([
             'next_service' => 'required|date',
             'mileage' => 'required|numeric|min:0',
             'mileage_next_service' => 'required|numeric|min:0',
             'payment_method' => 'required',
             'payment_reference' => 'required',
             'payment_documents' => 'nullable|file|max:5000',
             'remark' => 'max:2000'
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

     public function delete(Request $request, $id){

         if($request->ajax()){

             $service = LorryService::findOrFail($id);

             if($service->delete()){
                 ServiceItem::where('lorry_service_id', $service->id)->delete();
                 deleteTransaction($service->lorry_id, 'service', $service->id);
                 return response()->json(['success' => true, 'message' => "Service record deleted!"]);
             }else{

                 return response()->json(['success' => true, 'message' => "Failed to delete Service Record!"]);
             }
         }else{
             return response()->json(['error' => false, 'message' => "Invalid method!"]);
         }
     }
 }
