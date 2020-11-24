<?php

namespace App\Http\Controllers\Frontend\User\Lorry;

use App\Http\Controllers\Controller;
use App\Models\Lorry;
use App\Models\LorryInsurance;
use App\Models\LorryService;
use App\Models\ServiceItem;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 */
class LorryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        if($request->registration_number){

            $lorries = Lorry::where('plat_number', 'LIKE', "%$request->registration_number%")->paginate(10);

        }else{

            $lorries = Lorry::paginate(10);
        }
        return view('frontend.user.lorry.index', compact('lorries'));
    }

    public function create(Request $request){

        if(!$request->step){

            return redirect()->route('frontend.user.lorry.create', ['step' => 1]);
        }

        if($request->step == 1){

            #check plat number
            return view('frontend.user.lorry.create');
        }else{

            $plat_number = session('plat_number', 0);

            $lorry  = Lorry::orderBy('id', 'desc')->first();

            if($request->step == 2){

                if(!$lorry){
                    return redirect()->route('frontend.user.lorry.create', ['step' => 1])
                        ->withErrors('Lorry not found!');
                }

                return view('frontend.user.lorry.create', compact('lorry'));

            }else if($request->step == 3){

                #lorry insurance & roadtax
                if(is_null($lorry->model)){
                    return redirect()->route('frontend.user.lorry.create', ['step' => 2])
                        ->withErrors('Please complete lorry information first!');
                }

                if($lorry->latestInsurance){
                    return redirect()->route('frontend.user.lorry.create', ['step' => 4]);
                }

                return view('frontend.user.lorry.create', compact('lorry'));

            }else if($request->step == 4){

                if(!$lorry->latestInsurance){
                    return redirect()->route('frontend.user.lorry.create', ['step' => 3])
                        ->withErrors('Please complete Road Tax & Insurance information first!');
                }

                if($lorry->latestService){
                    return redirect()->route('frontend.user.lorry.create', ['step' => 5]);
                }
                return view('frontend.user.lorry.create', compact('lorry'));

            }else if($request->step == 5){

                #finish
                if(!$lorry->latestService){
                    return redirect()->route('frontend.user.lorry.create', ['step' => 4])
                        ->withErrors('Please complete last service information first!');
                }

                $lorry->is_completed = 1;
                $lorry->save();

                return view('frontend.user.lorry.create', compact('lorry'));

            }else{

                return redirect()->route('frontend.user.lorry.create', ['step' => 1])->withErrors('Invalid parameter!');
            }
        }
    }

    public function insert(Request $request){

        if(!$request->step){
            return redirect()->route('frontend.user.lorry.create', ['step' => 1]);
        }

        if($request->step == 1){

            $validate = $request->validate([
                'plat_number' => 'required'
            ]);

            $lorry = Lorry::where('plat_number', $request->plat_number)->first();

            if(!$lorry){
                $lorry = new Lorry();
                $lorry->plat_number = strtoupper($request->plat_number);
                $lorry->save();
                session(['lorry_id' => $lorry->id]);

                return redirect()->route('frontend.user.lorry.create', ['step' => 2])->withFlashSuccess('New lorry created!');
            }

            if($lorry->is_completed == 1){
                return  redirect()->back()->withFlashError('Ops! plat number already taken!');
            }

            session(['lorry_id' => $lorry->id]);
            return redirect()->route('frontend.user.lorry.create', ['step' => 2]);


        }else{

            $plat_number = session('plat_number', 0);
            $lorry  = Lorry::orderBy('id', 'desc')->first();

            if(!$lorry){
                return redirect()->route('frontend.user.lorry.create', ['step' => 1])
                    ->withErrors('Lorry not found!');
            }

            if($request->step == 2){
                #lorry information

                $validate = $request->validate([
                    'image' => 'file|image',
                    'brand' => 'required|min:2:max:20',
                    'model' => 'required|min:2|max:50',
                    'no_chassis' => 'required|min:2|max:50',
                    'no_engine' => 'required|min:2|max:50',
                    'class' => 'required|max:20',
                    'market_price' => 'required|numeric|min:0',
                    'loan_balance' => 'required|numeric|min:0',
                    'installment_amount' => 'required|numeric|min:0',
                    'engine_capacity' => 'required|numeric|min:0',
                    'registration_date' => 'required|date',
                    'btm' => 'required|numeric|min:0'
                ]);

                if($request->image){

                    $lorry->image = $request->image;
                    #upload file
                }

                $lorry->brand = strtoupper($request->brand);
                $lorry->model = strtoupper($request->model);
                $lorry->no_chassis = strtoupper($request->no_chassis);
                $lorry->no_engine = strtoupper($request->no_engine);
                $lorry->class = $request->class;
                $lorry->market_price = $request->market_price;
                $lorry->loan_balance = $request->loan_balance;
                $lorry->installment_amount = $request->installment_amount;
                $lorry->engine_capacity = $request->engine_capacity;
                $lorry->registration_date = $request->registration_date;
                $lorry->btm = $request->btm;

                $lorry->save();

                return redirect()->route('frontend.user.lorry.create', ['step' => 3])
                    ->withFlashSuccess('Lorry information saved!');

            }else if($request->step == 3){
                #lorry insurance & roadtax

                $validate = $request->validate([
                    'expire_date' => 'required|date',
                    'roadtax_price' => 'required|numeric',
                    'roatax_document' => 'file|max:5000',
                    'insurance_price' => 'required|numeric',
                    'insurance_document' => 'file|max:3000',
                    'remark' => 'max:200'
                ]);

                $insurance = new LorryInsurance();

                if($request->roatax_document){
                    $insurance->roatax_document = $request->roatax_document;
                }

                if($request->insurance_document){
                    $insurance->insurance_document = $request->insurance_document;
                }

                $insurance->lorry_id = $lorry->id;
                $insurance->is_read = 0;
                $insurance->expire_date = $request->expire_date;
                $insurance->roadtax_price = $request->roadtax_price;
                $insurance->insurance_price = $request->insurance_price;
                $insurance->remark = $request->remark;

                $amount =  $request->insurance_price + $request->roadtax_price;

                $insurance->save();

                insertTransaction($insurance->lorry_id, $insurance->id, 'insurance', '', 0.00, $amount);

                return redirect()->route('frontend.user.lorry.create', ['step' => 4])
                    ->withFlashSuccess('Lorry Road Tax & Insurance saved!');

                #lorry service
            }else if($request->step == 4){

                $validate = $request->validate([
                    'next_service' => 'required|date',
                    'mileage' => 'required|numeric',
                    'mileage_next_service' => 'required|numeric',
                    'amount' => 'required|numeric',
                    'payment_method' => 'required|in:0,1,2,',
                    'payment_reference' => 'required',
                    'payment_documents' => 'nullable|file:3000',
                    'remark' => 'max:200',
                ]);

                $service = new LorryService();

                if($request->payment_documents){
                    $service->payment_documents = $request->payment_documents;
                }

                $service->lorry_id = $lorry->id;
                $service->next_service = $request->next_service;
                $service->is_read = 0;
                $service->mileage = $request->mileage;
                $service->mileage_next_service = $request->mileage_next_service;
                $service->amount = $request->amount;
                $service->payment_method = $request->payment_method;
                $service->payment_reference = $request->payment_reference;
                $service->remark = $request->remark;
                $service->save();

                $item = new ServiceItem();
                $item->lorry_service_id = $service->id;
                $item->name = "Service";
                $item->qty = 1;
                $item->total_price = $request->amount;
                $item->save();

                insertTransaction($service->lorry_id, $service->id, 'service', '', 0.00, $request->amount);

                return redirect()->route('frontend.user.lorry.create', ['step' => 5])
                    ->withFlashSuccess('Lorry Service information saved!');
            }else{

                return redirect()->route('frontend.user.lorry.create', ['step' => 1])->withErrors('Invalid parameter!');
            }
        }
    }

    public function view($id){

        $lorry = Lorry::findOrFail($id);

        return view('frontend.user.lorry.view', compact('lorry'));
    }

    public function edit($id){

        $lorry = Lorry::findOrFail($id);

        return view('frontend.user.lorry.edit', compact('lorry'));
    }

    public function update(Request  $request, $id){


        $request->validate([
            'plat_number' => 'required|unique:lorries,plat_number,'.$id,
            'image' => 'file|image',
            'brand' => 'required|min:2:max:20',
            'model' => 'required|min:2|max:50',
            'no_chassis' => 'required|min:2|max:50',
            'no_engine' => 'required|min:2|max:50',
            'class' => 'required|max:20',
            'market_price' => 'required|numeric|min:0',
            'loan_balance' => 'required|numeric|min:0',
            'installment_amount' => 'required|numeric|min:0',
            'engine_capacity' => 'required|numeric|min:0',
            'registration_date' => 'required|date',
            'btm' => 'required|numeric|min:0'
        ]);

        $lorry = Lorry::findOrFail($id);

        $lorry->plat_number = $request->plat_number;
        $lorry->brand = strtoupper($request->brand);
        $lorry->model = strtoupper($request->model);
        $lorry->no_chassis = strtoupper($request->no_chassis);
        $lorry->no_engine = strtoupper($request->no_engine);
        $lorry->class = strtoupper($request->class);
        $lorry->market_price = $request->market_price;
        $lorry->loan_balance = $request->loan_balance;
        $lorry->installment_amount = $request->installment_amount;
        $lorry->engine_capacity = $request->engine_capacity;
        $lorry->registration_date = $request->registration_date;
        $lorry->btm = $request->btm;
        $lorry->save();

        return  redirect()->back()->withFlashSuccess('Lorry information updated!');

    }

}
