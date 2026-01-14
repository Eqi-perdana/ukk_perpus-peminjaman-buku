<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return response()->json(Siswa::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => 'required|unique:siswas',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        return response()->json(Siswa::create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->update($request->all());

        return response()->json($siswa);
    }

    public function destroy($id)
    {
        Siswa::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}
