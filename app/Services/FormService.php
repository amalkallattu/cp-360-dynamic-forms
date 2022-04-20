<?php

namespace App\Services;

use App\Models\Form;
use App\Models\FormElement;
use App\Models\FormElementOption;
use DB;

class FormService
{


    /**
     * saveData
     *
     * @param  mixed $request
     * @return void
     */
    public function saveData($request)
    {

        $form['name'] = $request->get('name');
        $formObj = Form::create($form);

        DB::beginTransaction();
        try {
            $dataReturned = $this->setData($request, $formObj);
            DB::commit();
            return $dataReturned;
        } catch (\Exception $e) {
            DB::rollback();
            return  ['status' => 'error', 'message' => "something went wrong, Please Try again"];
        }
    }

    /**
     * updateData
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateData($request, $id)
    {
        $formObj = Form::find($id);
        $formObj->name = $request->get('name');
        $formObj->save();

        DB::beginTransaction();
        try {
            $dataReturned = $this->setData($request, $formObj);
            DB::commit();
            return $dataReturned;
        } catch (\Exception $e) {
            DB::rollback();
            return  ['status' => 'error', 'message' => "something went wrong, Please Try again"];
        }
    }

    /**
     * setData
     *
     * @param  mixed $request
     * @param  mixed $formObj
     * @return void
     */
    public function setData($request, $formObj)
    {

        $removedIDs = $request->get('removed_ids');
        if ($removedIDs) {
            try {
                FormElement::whereIn('id', $removedIDs)->delete();
            } catch (\Illuminate\Database\QueryException $e) {
                return ['status' => 'error', 'message' => "Error.Can't delete form element with value"];
            }
        }


        $this->setElementValues($request, $formObj);


        return ['status' => 'success', 'message' => "Data saved succesfully"];
    }

    public function setElementValues($request, $formObj)
    {

        $elementsValues = $request->get('element_id');
        $elementsOptions = $request->get('element_options');
        $elementRequired = $request->get('is_required');
        $elementsLabel = $request->get('element_label');
        $formElementId = $request->get('form_element_id');
        if ($elementsValues) {
            foreach ($elementsValues as $key => $elementsValue) {
                if (isset($formElementId[$key])) {
                    $formElementObj = FormElement::find($formElementId[$key]);
                    FormElementOption::where('form_element_id', $formElementId[$key])->delete();
                } else {
                    $formElementObj = new FormElement;
                }

                $formElementObj->form_id = $formObj->id;
                $formElementObj->input_type_id = $elementsValue;
                $formElementObj->required = $elementRequired[$key];
                $formElementObj->label_name = $elementsLabel[$key];
                $formElementObj->save();
                $elementOptions = explode(',', $elementsOptions[$key]);

                if ($elementsOptions[$key]) {
                    foreach ($elementOptions as $elementOption) {
                        $formOptions['form_element_id'] = $formElementObj->id;
                        $formOptions['option'] = $elementOption;
                        FormElementOption::create($formOptions);
                    }
                }
            }
        }
    }
}
