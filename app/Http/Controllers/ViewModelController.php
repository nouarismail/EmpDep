<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

class ViewModelController extends Controller
{
   
    public function request(Request $request)
    {
        $data = $request->validate([
            'view_models'            => ['required', 'array', 'min:1'],
            'view_models.*.name'     => ['required', 'string'],
            'view_models.*.parameters' => ['nullable', 'array'],
        ]);

        $registry = Config::get('viewmodels', []);
        $out = [];

        foreach ($data['view_models'] as $vmReq) {
            $name   = $vmReq['name'];
            $params = $vmReq['parameters'] ?? [];

            if (! isset($registry[$name])) {
                throw ValidationException::withMessages([
                    'view_models' => ["Unknown view model: {$name}"],
                ]);
            }

            $class = $registry[$name];
            $vm    = $class::make($params);
            $out[$name] = $vm->toArray();
        }

        return response()->json([
            'isSuccessful' => true,
            'hasContent'   => true,
            'data'         => $out,
        ]);
    }

    public function executeCollection(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string'],
            'parameters' => ['nullable', 'array'],
        ]);

        $collections = Config::get('data_collections', []);
        $registry    = Config::get('viewmodels', []);
        $global      = $data['parameters'] ?? [];

        if (! isset($collections[$data['name']])) {
            throw ValidationException::withMessages(['name' => ['Unknown collection']]);
        }

        $out = [];
        foreach ($collections[$data['name']] as $entry) {
            $vmName = $entry['name'];
            if (! isset($registry[$vmName])) {
                continue;
            }

            // map collection parameters to VM parameters
            $mapped = [];
            foreach (($entry['map'] ?? []) as $vmKey => $globalKey) {
                if (array_key_exists($globalKey, $global)) {
                    $mapped[$vmKey] = $global[$globalKey];
                }
            }

            $class = $registry[$vmName];
            $vm    = $class::make($mapped);
            $out[$vmName] = $vm->toArray();
        }

        return response()->json([
            'isSuccessful' => true,
            'hasContent'   => true,
            'data'         => $out,
        ]);
    }
}
