<?php

namespace Mapper;

use Cog\YouTrack\Contracts\Project as ProjectContract;
use Cog\YouTrack\Contracts\ProjectCollection as ProjectCollectionContract;
use Cog\YouTrack\Contracts\ProjectMapper as ProjectMapperContract;
use Cog\YouTrack\Entity\Project\Project;

class ProjectMapper implements ProjectMapperContract
{
    protected $entityTable = 'project';
    protected $collection;

    public function __construct(StorageAdapterInterface $adapter, ProjectCollectionContract $collection)
    {
        $this->adapter = $adapter;
        $this->collection = $collection;
    }

    public function fetchById(string $id): ProjectContract
    {
        $this->adapter->select($this->entityTable, ['id' => $id]);
        if (!$row = $this->adapter->fetch()) {
            return;
        }

        return $this->createProject($row);
    }

    public function fetchAll(array $conditions = []): ProjectCollectionContract
    {
        $this->adapter->select($this->entityTable, $conditions);
        $rows = $this->adapter->fetchAll();

        return $this->createProjectCollection($rows);
    }

    protected function createProject(array $row): ProjectContract
    {
        $project = new Project();
        $project->fill($row);

        return $project;
    }

    protected function createProjectCollection(array $rows): ProjectCollectionContract
    {
        $this->collection->clear();
        if ($rows) {
            foreach ($rows as $row) {
                $this->collection[] = $this->createProject($row);
            }
        }

        return $this->collection;
    }
}
