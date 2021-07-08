<?php

namespace App\Services;

use Aws\Exception\AwsException;
use Aws\Rds\RdsClient;

class InstanceManagement
{
    /**
     * @var RdsClient
     */
    private $rdsClient;

    /**
     * InstanceManagement constructor.
     * @param RdsClient $rdsClient
     */
    public function __construct(RdsClient $rdsClient)
    {
        $this->rdsClient = $rdsClient;
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function list()
    {
        try {
            $result = $this->rdsClient->describeDBInstances([]);
        } catch (AwsException $e) {
            return 'An error occurred';
        }

        return $result['DBInstances'];
    }

    /**
     * @param string $id
     * @return string
     * @throws \Throwable
     */
    public function status($id)
    {
        try {
            $result = $this->rdsClient->describeDBInstances(['DBInstanceIdentifier' => $id]);
        } catch (AwsException $e) {
            return $e->getAwsErrorMessage();
        }

        return $result['DBInstances'][0];
    }

    /**
     * @param string $id
     * @param string $class
     * @param string $engine
     * @return string
     */
    public function create($id, $class, $engine)
    {
        try {
            $this->rdsClient->createDBInstance([
                'DBInstanceIdentifier' => $id,
                'DBInstanceClass' => $class,
                'Engine' => $engine,
                'MasterUsername' => 'username',
                'MasterUserPassword' => 'password',
                'AllocatedStorage' => 20,
            ]);
        } catch (AwsException $e) {
            return $e->getAwsErrorMessage();
        }

        return 'Creating instance';
    }

    /**
     * @param string $id
     * @return string
     */
    public function delete($id)
    {
        try {
            $this->rdsClient->deleteDBInstance([
                'DBInstanceIdentifier' => $id,
                'DeleteAutomatedBackups' => true,
                'SkipFinalSnapshot' => true,
            ]);
        } catch (AwsException $e) {
            return $e->getAwsErrorMessage();
        }

        return 'Deleting instance';
    }

    /**
     * @param string $id
     * @return string
     */
    public function start($id)
    {
        try {
            $this->rdsClient->startDBInstance([
                'DBInstanceIdentifier' => $id,
            ]);
        } catch (AwsException $e) {
            return $e->getAwsErrorMessage();
        }

        return 'Starting instance';
    }

    /**
     * @param string $id
     * @return string
     */
    public function stop($id)
    {
        try {
            $this->rdsClient->stopDBInstance([
                'DBInstanceIdentifier' => $id,
            ]);
        } catch (AwsException $e) {
            return $e->getAwsErrorMessage();
        }

        return 'Stopping instance';
    }
}
