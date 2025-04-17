<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Notify\Models\Contact;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateNotifyContactsTable extends XotBaseMigration {
    protected ?string $model_class = Contact::class;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) {
                $table->increments('id');
                $table->morphs('model');
                $table->string('contact_type')->nullable();
                $table->string('value')->nullable();
                $table->integer('user_id')->nullable();
                $table->timestamp('verified_at')->nullable();
                $table->timestamps();
                $table->string('updated_by')->nullable();
                $table->string('created_by')->nullable();
            }
        );
        $this->tableUpdate(
            function (Blueprint $table) {
                if (! $this->hasColumn('token')) {
                    $table->string('token')->nullable();
                }
            });
    }
}
