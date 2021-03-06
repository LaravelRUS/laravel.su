<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateVersionsTable
 */
class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('versions', static function (Blueprint $table): void {
            $table->increments('id');
            $table->string('title')
                ->comment('Current version name (like "1.0")');
            $table->string('default_page')
                ->comment('Default page urn')
                ->default('installation');
            $table->string('menu_page')
                ->comment('Menu page urn')
                ->default('documentation');
            $table->boolean('is_documented')
                ->comment('Marks that documentation version is available')
                ->default(false);
            $table->timestamp('created_at')
                ->useCurrent();
            $table->timestamp('updated_at')
                ->nullable();

            // Keys
            $table->unique('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('versions');
    }
}
