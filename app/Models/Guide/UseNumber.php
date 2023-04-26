<?php

namespace App\Models\Guide;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property int|null $category_id
 * @property int|null $post_id
 * @property int|null $note_id
 * @property int|null $number
 */
interface UseNumber
{
    public function numbersQuery(): Builder;
}
