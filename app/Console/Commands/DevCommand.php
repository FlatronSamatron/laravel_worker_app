<?php

namespace App\Console\Commands;

use App\Models\Department;
use App\Models\Position;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectWorker;
use App\Models\Worker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class DevCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'develop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Some develop';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->prepareData();
        $this->preparedManyToMany(['Shop', "Blog"]);

        $worker = Worker::find(1);
        $profile = Profile::find(1);
        $positions = Position::find(4);
        $project = Project::find(1);

//        dd(
//            $profile->worker->toArray(),
//            $worker->profile->toArray(),
//            $worker->position->toArray(),
//            $positions->workers->toArray(),
//            $project->workers->toArray(),
//            $worker->projects->toArray()
//        );

//        $worker->projects()->toggle($project->id);
//
//        $project->workers()->attach;



//        $workers = Worker::inRandomOrder()
//            ->limit(5)
//            ->pluck('id');
//
//
//        $project->workers()->sync($workers);

        $departmentItId = Department::where('title', 'IT')->first()->id;
        $department = Department::find($departmentItId);
        dd($department->workers->toArray());

        return Command::SUCCESS;
    }

    protected function prepareData() {
        $departments = $this->getDepartmentData(['IT', 'Analytics']);

        $this->getPositionData();

        $workerData = $this->getWorkerData();
        $worker = Worker::create($workerData);

        $profileData = $this->getWorkerProfile($worker->id);
        Profile::create($profileData);
    }

    public function getDepartmentData(array $titles)
    {
        return array_map(function($department){
            return Department::updateOrCreate([
                'title' => $department
            ]);
        }, $titles);
    }

    public function getPositionData()
    {
        $positions = ['Front-end', 'Back-end', 'Full-stack', 'Designer', 'PM'];

        $itDepartment = Department::where('title', 'IT')->first()->id;

        foreach ($positions as $position){
            Position::updateOrCreate([
                'title' => $position,
                'department_id' => $itDepartment
            ]);
        }
    }

    protected function getWorkerData(): array
    {
        $names = ['John', 'Mary', 'Nikolay', 'Sergey', 'Bob'];
        $surnames = ['Coder', 'Green', 'Orange', 'Brown', 'Banks'];
        $positions = Position::all()->pluck('id')->toArray();

        $name = $names[mt_rand(0, count($names)-1)];
        $surname = $surnames[mt_rand(0, count($surnames)-1)];
        $email= "{$name}_{$surname}@email.com";
        $position = $positions[mt_rand(0, count($positions)-1)];

        $description = "I am {$name} {$surname}";
        $age = mt_rand(15, 35);

        return [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'position_id' => $position,
            'age' => $age,
            'description' => $description,
            'is_married' => (bool) mt_rand(0, 1)
        ];
    }

    protected function getWorkerProfile($workerId): array
    {
        $cities = ['Kyiv', 'New York', 'Paris', 'Tokio', 'Gong Kong'];
        $skills = ['Junior', 'Middle', 'Senior', 'CEO'];

        $city = $cities[mt_rand(0, count($cities)-1)];
        $skill = $skills[mt_rand(0, count($skills)-1)];
        $experience = mt_rand(1, 5);
        $timestamp = rand( strtotime("Jan 01 2010"), strtotime("Nov 01 2016") );
        $date = date("Y-m-d H:i:s",$timestamp);

        return [
            'worker_id' => $workerId,
            'city' => $city,
            'skill' => $skill,
            'experience' => $experience,
            'finished_study_at' => $date
        ];
    }

    public function preparedManyToMany(array $projects): void
    {
        if(Project::exists()){
            return;
        }

        foreach ($projects as $project) {
            $newProject = Project::create([
                'title' => $project
            ]);

            $this->createProjectWorkers($newProject->id);
        }
    }

    public function createProjectWorkers(int $id = null): void
    {
        $workers = Worker::inRandomOrder()
            ->limit(5)
            ->pluck('id');

        foreach ($workers as $worker) {
            ProjectWorker::create([
                'project_id' => $id,
                'worker_id' => $worker,
            ]);
        }
    }
}

