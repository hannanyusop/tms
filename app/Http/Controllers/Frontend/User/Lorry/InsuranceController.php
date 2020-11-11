<?php
 namespace App\Http\Controllers\Frontend\User\Lorry;

 use App\Http\Controllers\Controller;
 use App\Models\Lorry;
 use App\Models\LorryInsurance;
 use App\Models\LorryService;
 use App\Models\ServiceItem;
 use Illuminate\Http\Request;

 class InsuranceController extends Controller{

     public function create($lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         return view('frontend.user.lorry.insurance.create', compact('lorry'));

     }

     public function insert(Request $request, $lorry_id){

         $lorry = Lorry::findOrFail($lorry_id);

         $validate = $request->validate([
             'expire_date' => 'required',
             'roadtax_price' => '',
             'roatax_document' => '',
             'insurance_price' => '',
             'insurance_document' => '',
             'amount' => '',
             'remark' => ''
         ]);

         $insurance = new LorryInsurance();

         $insurance->lorry_id = $lorry->id;
         $insurance->is_read = 0;
         $insurance->expire_date = $request->expire_date;
         $insurance->roadtax_price = $request->roadtax_price;
         $insurance->roatax_document = $request->roatax_document; #uploadfile
         $insurance->insurance_price = $request->insurance_price;
         $insurance->insurance_document = $request->insurance_document; #upload file
         $insurance->amount = $request->roadtax_price+$request->insurance_price;
         $insurance->remark = $request->remark;

         if($insurance->save()){
             insertTransaction($lorry->id, $insurance->id, 'insurance', $insurance->remark, 0.00,$insurance->amount);
             return redirect()->route('frontend.user.lorry.view', $lorry->id)->withFlashSuccess('Service record inserted!');
         }

     }

     public function edit($id){

         $insurance = LorryInsurance::findOrFail($id);

         return view('frontend.user.lorry.insurance.edit', compact('insurance'));

     }

     public function update(Request $request, $id){

         $insurance = LorryInsurance::findOrFail($id);

         $validate = $request->validate([
             'expire_date' => 'required',
             'roadtax_price' => '',
             'roatax_document' => '',
             'insurance_price' => '',
             'insurance_document' => '',
             'amount' => '',
             'remark' => ''
         ]);


         $insurance->expire_date = $request->expire_date;
         $insurance->roadtax_price = $request->roadtax_price;
         $insurance->roatax_document = $request->roatax_document; #uploadfile
         $insurance->insurance_price = $request->insurance_price;
         $insurance->insurance_document = $request->insurance_document; #upload file
         $insurance->amount = $request->roadtax_price+$request->insurance_price;
         $insurance->remark = $request->remark;

         if($insurance->save()){
             updateTransaction($insurance->lorry_id, 'insurance', $insurance->id,$insurance->remark, 0.00, $insurance->amount);
             return redirect()->route('frontend.user.lorry.view', $insurance->lorry_id)->withFlashSuccess('Insurance record updated!');
         }
     }

     public function delete($id){

         $insurance = LorryInsurance::findOrFail($id);
         
         if($insurance->delete()){
             deleteTransaction($insurance->lorry_id, 'insurance', $insurance->id);
             return redirect()->route('frontend.user.lorry.view', $insurance->lorry_id)->withFlashSuccess('Insurance record deleted!');
         }

         return true;
     }
 }
