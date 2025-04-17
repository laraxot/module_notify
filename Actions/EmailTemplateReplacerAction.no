<?php

declare(strict_types=1);

namespace Modules\Notify\Actions;

use Illuminate\Database\Eloquent\Model;
use Modules\ExtraField\Models\ExtraField;
use Modules\ExtraField\Models\ExtraFieldMorph;
use Spatie\QueueableAction\QueueableAction;

class EmailTemplateReplacerAction
{
    use QueueableAction;

    /**
     * Execute the action.
     */
    public function execute(string $body_html, Model $model, string $keyword): string
    {
        $text = $body_html;

        $model_to_array = $model->toArray();

        foreach ($model_to_array as $key => $value) {
            if (is_string($value) || null == $value) {
                if ('profile' == $keyword) {
                    $val_field_id = ExtraField::firstWhere('name', $key)->id ?? $key.' NON PRESENTE';
                    $val = ExtraFieldMorph::firstWhere(['user_id' => (string) auth()->id(), 'extra_field_id' => $val_field_id, 'model_type' => 'profile'])?->value ?? ' NON PRESENTE';
                } else {
                    $val = $model->{$key};
                }

                $text = str_replace('['.$keyword.'.'.$key.']', (string) $val, $text);
            }
        }

        $text = str_replace('[now]', now()->format('d/m/Y'), $text);

        return $text;
    }
}
