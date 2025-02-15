<?php

namespace Waterhole\Forms\Fields;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Waterhole\Forms\Field;
use Waterhole\Models\Taxonomy;

class TaxonomyOptions extends Field
{
    public function __construct(public ?Taxonomy $model)
    {
    }

    public function render(): string
    {
        return <<<'blade'
            <div class="field">
                <div class="field__label">Options</div>

                <div class="stack gap-sm">
                    <label class="choice">
                        <input type="hidden" name="is_required" value="0">
                        <input type="checkbox" name="is_required" value="1" @checked($model->is_required)>
                        Require a tag to be selected on post creation
                    </label>
                    <label class="choice">
                        <input type="hidden" name="allow_multiple" value="0">
                        <input type="checkbox" name="allow_multiple" value="1" @checked($model->allow_multiple)>
                        Allow selection of multiple tags
                    </label>
                </div>
            </div>
        blade;
    }

    public function validating(Validator $validator): void
    {
        $validator->addRules([
            'is_required' => ['boolean'],
            'allow_multiple' => ['boolean'],
        ]);
    }

    public function saving(FormRequest $request): void
    {
        $this->model->is_required = $request->validated('is_required');
        $this->model->allow_multiple = $request->validated('allow_multiple');
    }
}
