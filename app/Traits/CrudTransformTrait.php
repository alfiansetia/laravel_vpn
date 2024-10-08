<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait CrudTransformTrait
{
    protected $model;
    protected $transform;

    public $with = [];
    public $filters = [];

    public function paginate()
    {
        $data = $this->model->filter($this->filters)->paginate(10);
        return response()->json($this->transform::collection($data));
    }

    public function destroyBatch(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'id'    => 'required|array|min:1',
                'id.*'  => 'required|integer|exists:' . $this->model . ',id',
            ]);
            $deleted = 0;
            foreach ($request->id as $id) {
                $model = $this->model::findOrFail($id);
                $model->delete();
                if ($model) {
                    $deleted++;
                }
            }
            $data = ['message' => 'Success Delete : ' . $deleted . ' & Fail : ' . (count($request->id) - $deleted), 'data' => ''];
            return response()->json($data);
        } else {
            abort(404);
        }
    }

    public function destroy(Request $request, string $id)
    {
        if ($request->ajax()) {
            $data = $this->model::find($id);
            if (!$data) {
                return response()->json(['message' => 'Data Not Found!'], 404);
            }
            $data->delete();
            return response()->json(['message' => 'Success Delete Data']);
        } else {
            abort(404);
        }
    }

    public function show(Request $request, string $id,)
    {
        if ($request->ajax()) {
            $data = $this->model::with($this->with)->find($id);
            if (!$data) {
                return response()->json(['message' => 'Data Not Found!'], 404);
            }
            return response()->json(['message' => '', 'data' => $data]);
        } else {
            abort(404);
        }
    }
}
