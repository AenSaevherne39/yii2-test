<?php

namespace app\jobs;

use Yii;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\queue\JobInterface;

class ExportCsvJob extends BaseObject implements JobInterface
{
    /**
     * @var string
     */
    public string $email;

    /**
     * @var array
     */
    public array $searchParams;

    public function execute($queue)
    {
        // TODO: Implement csv creation and sending to email
    }

    /**
     * @param string $email
     * @param array $searchParams
     *
     * @return ExportCsvJob
     * @throws InvalidConfigException
     */
    public static function create(string $email, array $searchParams): ExportCsvJob
    {
        return Yii::createObject([
            'class' => static::class,
            'email' => $email,
            'searchParams' => $searchParams,
        ]);
    }
}
