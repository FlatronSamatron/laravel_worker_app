<?php

namespace App\Http\Controllers;

use App\Http\Requests\Worker\IndexRequest;
use App\Http\Requests\Worker\StoreRequest;
use App\Http\Requests\Worker\UpdateRequest;
use App\Models\Worker;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

//    index
//    show
//
//    create
//    store
//
//    edit
//    update
//
//    delete

class WorkerController extends Controller
{
    public function index(IndexRequest $request): View
    {
        $filter = $this->workerFilter($request);

        $workers = $filter->simplePaginate(5);

        return view('worker.index', compact('workers'));
    }


    public function show(Worker $worker): View
    {
        return view('worker.show', compact('worker'));
    }

    public function create(): View
    {
        return view('worker.create')->with('worker', $this->getWorkerInfo());
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['is_married'] = isset($data['is_married']);

        Worker::create($data);

        return redirect()->route('worker.index');
    }

    public function edit(Worker $worker)
    {
        return view('worker.edit', compact('worker'));
    }

    public function update(UpdateRequest $request, Worker $worker)
    {
        $data = $request->validated();

        $data['is_married'] = isset($data['is_married']);

        $worker->update($data);

        return redirect()->route('worker.show', $worker->id);
    }

    public function delete(Worker $worker)
    {
        $worker->delete();

        return redirect()->route('worker.index');
    }

    protected function workerFilter($request){
        $data = $request->validated();
        $workerQuery = Worker::query();

        if(isset($data['name'])) {
            $workerQuery->where('name', 'like', "%{$data['name']}%");
        }

        if(isset($data['surname'])) {
            $workerQuery->where('surname', 'like', "%{$data['surname']}%");
        }

        if(isset($data['email'])) {
            $workerQuery->where('email', 'like', "%{$data['email']}%");
        }

        if(isset($data['from'])) {
            $workerQuery->where('age', '>', $data['from']);
        }

        if(isset($data['to'])) {
            $workerQuery->where('age', '<', $data['to']);
        }

        if(isset($data['description'])) {
            $workerQuery->where('description', 'like', "%{$data['description']}%");
        }

        if(isset($data['is_married'])) {
            $workerQuery->where('is_married', true);
        }

        return $workerQuery;
    }

    protected function getWorkerInfo(): array
    {
        $names = ['John', 'Mary', 'Nikolay', 'Sergey', 'Bob'];
        $surnames = ['Bred', 'Green', 'Orange', 'Brown', 'Banks'];

        $name = $names[mt_rand(0, count($names)-1)];
        $surname = $surnames[mt_rand(0, count($surnames)-1)];
        $email= "{$name}_{$surname}@email.com";
        $description = "I am {$name} {$surname}";
        $age = mt_rand(15, 35);

        return [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'age' => $age,
            'description' => $description
        ];
    }
}
