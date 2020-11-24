<?php
 namespace App\Http\Controllers\Frontend\User\Lorry;

 use App\Http\Controllers\Controller;
 use App\Models\Lorry;
 use App\Models\LorryInstallment;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;

 class InstallmentController extends Controller{

     public function index(){

         $installments = LorryInstallment::get();

         $collect = collect($installments);

         $groups = $collect->groupBy('date');

         return view('frontend.user.lorry.installment.index', compact('groups'));
     }

     public function create(){

         $paid_id = LorryInstallment::whereDate('date', date('Y-m-1'))->pluck('lorry_id');

         $lorries = Lorry::where('loan_balance', '>', 0)
             ->whereNotIn('id', $paid_id)
             ->get();

         return view('frontend.user.lorry.installment.create', compact('lorries'));
     }

     public function insert(Request $request){

         $request->validate([
             'amount[*]' => 'required|numeric|min:0',
             'remark[*]' => 'max:200'
         ]);


         if(is_null($request->amount)){
             return redirect()->route('frontend.user.lorry.installment.index')->withFlashSuccess('No installment record inserted!');
         }

         $total = 0;

         foreach ($request->amount as $lorry_id => $amount){

             $lorry = Lorry::find($lorry_id);

             if($lorry){

                 if($lorry->loan_balance > 0){

                     $installment = LorryInstallment::whereDate('date', date('Y-m-1'))
                         ->where('lorry_id', $lorry_id)
                         ->first();

                     if(!$installment){

                         $installment = new LorryInstallment();
                         $installment->lorry_id = $lorry_id;
                         $installment->date = date('Y-m-1');
                         $installment->amount = $amount;
                         $installment->loan_balance = $lorry->loan_balance-$amount;
                         $installment->remark = "";


                         if($installment->save()){
                             $lorry->decrement('loan_balance', $amount);

                             insertTransaction($lorry_id, $installment->id, 'installment', "Installment for ".date('M/Y'), 0.00, $installment->amount);
                             $total++;
                         }
                     }

                 }
             }

         }
         return redirect()->route('frontend.user.lorry.installment.index')->withFlashSuccess($total. ' installment record inserted!');
     }

     public function view($date){

         $installments = LorryInstallment::whereDate('date', $date)->get();

         return view('frontend.user.lorry.installment.view', compact('installments', 'date'));
     }

     public function delete(Request $request, $id){

         if($request->ajax()){
             $installment = LorryInstallment::findOrFail($id);

             if($installment->date == date('Y-m-1')){

                 if($installment->lorry){
                     $installment->lorry->increment($installment->amount);
                 }

                 if($installment->delete()){
                     deleteTransaction($installment->lorry_id, 'installment', $installment->id);

                     return response()->json(['success' => true, 'message' => "Installment record deleted!"]);
                 }

             }else{

                 return response()->json(['error' => true, 'message' => "Ops! Only current month record can be deleted"]);
             }
         }else{
             return response()->json(['success' => false, 'message' => "Invalid method!"]);

         }
     }
 }
