<?php

declare(strict_types=1);

namespace Modules\Notify\Models\Panels;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Cms\Models\Panels\XotBasePanel;
use Modules\Cms\Contracts\RowsContract;

class ContactPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Notify\Models\Contact';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static string $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     */
    public function with(): array {
        return [];
    }

    public function search(): array {
        return [];
    }

    /**
     * on select the option id.
     *
     * quando aggiungi un campo select, è il numero della chiave
     * che viene messo come valore su value="id"
     *
     * @param \Modules\Notify\Models\Contact $row
     *
     * @return int|string|null
     */
    public function optionId($row) {
        $key = $row->getKey();
        if (null === $key || (! is_string($key) && ! is_int($key))) {
            throw new \Exception('['.__LINE__.']['.class_basename(__CLASS__).']');
        }

        return $key;
    }

    /**
     * on select the option label.
     *
     * @param \Modules\Notify\Models\Contact $row
     */
    public function optionLabel($row): string {
        return 'To Set';
    }

    /**
     * index navigation.
     */
    public function indexNav(): ?Renderable {
        return null;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public function indexQuery(array $data, $query) {
        // return $query->where('user_id', $request->user()->id);
        return $query;
    }

    /**
     * Get the fields displayed by the resource.
        'value'=>'..',
     */
    public function fields(): array {
        return [
            0 => (object) [
                'type' => 'Bigint',
                'name' => 'model_id',
                'rules' => 'required',
                'comment' => null,
            ],
            1 => (object) [
                'type' => 'String',
                'name' => 'model_type',
                'rules' => 'required',
                'comment' => null,
            ],
            2 => (object) [
                'type' => 'String',
                'name' => 'contact_type',
                'comment' => null,
            ],
            3 => (object) [
                'type' => 'String',
                'name' => 'value',
                'comment' => null,
            ],
            4 => (object) [
                'type' => 'Datetime',
                'name' => 'verified_at',
                'comment' => null,
            ],
            5 => (object) [
                'type' => 'Datetime',
                'name' => 'updated_at',
                'comment' => null,
            ],
            6 => (object) [
                'type' => 'Datetime',
                'name' => 'created_at',
                'comment' => null,
            ],
            7 => (object) [
                'type' => 'String',
                'name' => 'updated_by',
                'comment' => null,
            ],
            8 => (object) [
                'type' => 'String',
                'name' => 'created_by',
                'comment' => null,
            ],
            9 => (object) [
                'type' => 'Integer',
                'name' => 'user_id',
                'comment' => null,
            ],
            10 => (object) [
                'type' => 'String',
                'name' => 'token',
                'comment' => null,
            ],
        ];
    }

    /**
     * Get the tabs available.
     */
    public function tabs(): array {
        $tabs_name = [];

        return $tabs_name;
    }

    /**
     * Get the cards available for the request.
     */
    public function cards(Request $request): array {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function filters(Request $request = null): array {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     */
    public function lenses(Request $request): array {
        return [];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(): array {
        return [];
    }
}
