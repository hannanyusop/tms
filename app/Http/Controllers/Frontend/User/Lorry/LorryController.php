<?php

namespace App\Http\Controllers\Frontend\User\Lorry;

use App\Http\Controllers\Controller;
use App\Models\Lorry;
use App\Models\LorryInsurance;
use App\Models\LorryService;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 */
class LorryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lorries = Lorry::paginate(10);
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
            $lorry  = Lorry::where('plat_number', $plat_number)->first();

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

                $lorry->is_complete = 1;
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
            $lorry  = Lorry::where('plat_number', $plat_number)->first();

            if(!$lorry){
                return redirect()->route('frontend.user.lorry.create', ['step' => 1])
                    ->withErrors('Lorry not found!');
            }

            if($request->step == 2){
                #lorry information

                $validate = $request->validate([
                    'image' => 'file|image',
                    'brand' => 'required',
                    'model' => 'required',
                    'no_chassis' => 'required',
                    'no_engine' => 'required',
                    'class' => 'required',
                    'engine_capacity' => 'required',
                    'registration_date' => 'required|date',
                    'btm' => 'required|numeric'
                ]);

                if($request->image){

                    $lorry->image = $request->image;
                    #upload file
                }

                $lorry->brand = $request->brand;
                $lorry->model = $request->model;
                $lorry->no_chassis = $request->no_chassis;
                $lorry->no_engine = $request->no_engine;
                $lorry->class = $request->class;
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
                    'roatax_document' => 'file|max:3000',
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

                $insurance->save();

                return redirect()->route('frontend.user.lorry.create', ['step' => 4])
                    ->withFlashSuccess('Lorry Road Tax & Insurance saved!');

                #lorry service
            }else if($request->step == 4){

                $validate = $request->validate([
                    'next_service' => 'required|date',
                    'mileage' => 'required|numeric',
                    'mileage_next_service' => 'required|numeric',
                    'amount' => 'required|numeric',
                    'payment_method' => 'required|in:1,2',
                    'payment_reference' => '',
                    'payment_documents' => 'file:3000',
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

}
