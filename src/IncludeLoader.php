<?php
namespace ND\ApiHelper;

use League\Fractal\TransformerAbstract;

trait IncludeLoader
{
    /**
     * Permite el eadger loading de los includes permitidos por el transformer
     *
     * @param $includeString
     * @param TransformerAbstract $transformer
     * @return mixed
     */
    public function withIncludes($includeString, TransformerAbstract $transformer)
    {
        $keys = explode(',', $includeString);

        $toApply = [];

        foreach ($keys as $key) {
            if (in_array($key, $transformer->getAvailableIncludes())) {
                $toApply[] = $key;
            }
        }

        return $this->with($toApply);
    }
}
