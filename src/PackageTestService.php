<?php


namespace Cdg;


use Illuminate\Database\Query\Builder;

class PackageTestService
{
    /**
     * 静态方式获取实例
     *
     * @param bool $isSingleton
     * @return static
     */
    public static function make($isSingleton = true)
    {
        if (!$isSingleton) {
            return new static;
        }

        $app = app();
        if (!$app->has(static::class)) {
            $app->singleton(static::class, function () {
                return new static();
            });
        }
        return $app->make(static::class);
    }

    /**
     * 执行更新操作
     *
     * @param string $modelClass 模型类
     * @param array $attributes
     * @param array $values
     * @return bool
     * @throws \Exception
     */
    public function do($modelClass, array $attributes = [], array $values = [])
    {
        try {

            $modelClass::query()->where($attributes)->update($values);

        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }

        return true;
    }
}
