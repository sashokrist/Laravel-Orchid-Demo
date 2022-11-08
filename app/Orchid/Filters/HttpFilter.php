<?php

namespace App\Orchid\Filters;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Orchid\Filters\HttpFilter as OrchidHttpFilter;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HttpFilter extends OrchidHttpFilter
{
    /**
     * Column names are alphanumeric strings that can contain
     * underscores (`_`) but can't start with a number.
     */
    private const VALID_COLUMN_NAME_REGEX = '/^(?!\d)[A-Za-z0-9_>-]*$/';
    /**
     * @param string $column
     *
     * @return string
     */
    public static function sanitize(string $column): string
    {
        abort_unless(preg_match(self::VALID_COLUMN_NAME_REGEX, $column), ResponseAlias::HTTP_BAD_REQUEST);

        return $column;
    }
    /**
     * @param Builder $builder
     */
    public function addSortsToQuery(Builder $builder):void
    {
        $allowedSorts = $this->options->get('allowedSorts');

        $this->sorts
            ->each(function (string $sort) use ($builder, $allowedSorts) {
                $descending = str_starts_with($sort, '-');
                $key = ltrim($sort, '-');
                $property = Str::before($key, '.');
                $key = str_replace('.', '->', $key);

                if ($this->request->sort === 'tag') {
                    $builder->orderByTagName($builder, $descending ? 'desc' : 'asc');
                }
                if ($allowedSorts->contains($property)) {
                    $key = $this->sanitize($key);
                    $builder->orderBy($key, $descending ? 'desc' : 'asc');
                }
            });
    }
}
