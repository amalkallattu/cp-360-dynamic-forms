<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormElement;
use App\Models\FormElementOption;
use App\Models\FormSubmission;
use App\Models\InputType;
use App\Services\FormService;
use Illuminate\Http\Request;

class FormsController extends Controller
{

    /**
     * formService
     *
     * @var mixed
     */
    private $formService;

    /**
     * __construct
     *
     * @param  mixed $formService
     * @return void
     */
    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $forms = Form::paginate(10);
        return view('forms.forms', compact('forms'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $inputTypes = InputType::all();
        return view('forms.create', compact('inputTypes'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $savedResponse = $this->formService->saveData($request);

        return redirect(route('forms'))->with('message', $savedResponse['message']);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $form = Form::find($id);
        $inputTypes = InputType::all();
        return view('forms.edit', compact('inputTypes', 'form'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $savedResponse =  $this->formService->updateData($request, $id);

        return redirect(route('forms'))->with('message', $savedResponse['message']);
    }

    /**
     * submissions
     *
     * @param  mixed $id
     * @return void
     */
    public function submissions($id)
    {
        $submissions = FormSubmission::where('form_id', $id)->with('submittedData', 'submittedData.element')->paginate(10);

        return view('forms.submissions', compact('submissions'));
    }
}
