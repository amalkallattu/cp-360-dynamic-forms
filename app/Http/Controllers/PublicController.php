<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\FormSubmissionsData;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $forms = Form::paginate(10);
        return view('public.forms', compact('forms'));
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $formData = Form::where("id", $id)->with('elements')->first();

        return view('public.form-view', compact('formData'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {

        $formId = $request->get('form_id');
        $formObj = Form::find($formId);

        $formData['form_id'] =  $formId;
        $formSubmitted = FormSubmission::create($formData);

        foreach ($formObj->elements as $element) {

            $formElementValues['form_submission_id'] =  $formSubmitted->id;
            $formElementValues['form_element_id'] =  $element->id;
            $formElementValues['data'] =  $request->get('dynamic_element_' . $element->id);
            FormSubmissionsData::create($formElementValues);
        }

        return redirect(route('public.forms'))->with('message', "Form Submitted Succesfully");
    }
}
