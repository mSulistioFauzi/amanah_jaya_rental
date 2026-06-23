<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Menampilkan seluruh data mobil
     */
    public function index()
    {
        $cars = Car::latest()->get();

        return view('car.index', compact('cars'));
    }

    /**
     * Menampilkan form tambah mobil
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Menyimpan data mobil baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil'  => 'required|max:255',
            'merk'        => 'required|max:255',
            'tahun'       => 'required|numeric',
            'plat_nomor'  => 'required|unique:cars,plat_nomor',
            'harga_sewa'  => 'required|numeric|min:0',
            'status'      => 'required',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'   => 'nullable'
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/cars'), $filename);

            $data['gambar'] = $filename;
        }

        Car::create($data);

        return redirect()
            ->route('car.index')
            ->with('success', 'Data mobil berhasil ditambahkan');
    }

    /**
     * Detail mobil
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);

        return view('car.show', compact('car'));
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);

        return view('car.edit', compact('car'));
    }

    /**
     * Update data mobil
     */
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'nama_mobil'  => 'required|max:255',
            'merk'        => 'required|max:255',
            'tahun'       => 'required|numeric',
            'plat_nomor'  => 'required|unique:cars,plat_nomor,' . $id,
            'harga_sewa'  => 'required|numeric|min:0',
            'status'      => 'required',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'   => 'nullable'
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {

            // Hapus gambar lama jika ada
            if ($car->gambar && file_exists(public_path('uploads/cars/' . $car->gambar))) {
                unlink(public_path('uploads/cars/' . $car->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/cars'), $filename);

            $data['gambar'] = $filename;
        }

        $car->update($data);

        return redirect()
            ->route('car.index')
            ->with('success', 'Data mobil berhasil diperbarui');
    }

    /**
     * Hapus mobil
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        if ($car->gambar && file_exists(public_path('uploads/cars/' . $car->gambar))) {
            unlink(public_path('uploads/cars/' . $car->gambar));
        }

        $car->delete();

        return redirect()
            ->route('car.index')
            ->with('success', 'Data mobil berhasil dihapus');
    }

    /**
     * Menampilkan daftar mobil untuk customer
     */
    public function list()
    {
        $cars = Car::where('status', 'tersedia')
            ->latest()
            ->get();

        return view('customer.cars', compact('cars'));
    }
}
