import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';

const Create = () => {
    const { mahasiswa, lab, dosen, matakuliah, errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        id_mahasiswa: '',
        id_lab: '',
        id_dosen: '',
        id_matkul: '',
        tanggal: '',
        jam_pinjam: '',
        jam_kembali: '',
        keperluan: '',
        kategori: '',
        proses: '',
        status: ''
    });

    function handleChange(e) {
        const key = e.target.name;
        const value = e.target.value;
        setValues(values => ({
            ...values,
            [key]: value
        }));
    }

    function handleSubmit(e) {
        e.preventDefault();
        setSending(true);
        Inertia.post(route('PeminjamanLab.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <React.Fragment>
            <h1 className="mb-8 font-bold text-3xl">
                <InertiaLink
                    href={route('PeminjamanLab.index')}
                    className="text-indigo-600 hover:text-indigo-700"
                    as="a"
                >
                    Peminjaman Lab
                </InertiaLink>
                <span className="text-indigo-600 font-medium"> /</span> Tambah Data
            </h1>
            <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                <form onSubmit={handleSubmit}>
                    <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Mahasiswa"
                            name="id_mahasiswa"
                            errors={errors.id_mahasiswa}
                            value={values.id_mahasiswa}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            {mahasiswa.map(({ id, nama_mahasiswa }) => (
                                <option key={id} value={id}>
                                    {nama_mahasiswa}
                                </option>
                            ))}
                        </SelectInput>
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Laboratorium"
                            name="id_lab"
                            errors={errors.id_lab}
                            value={values.id_lab}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            {lab.map(({ id, nama_lab }) => (
                                <option key={id} value={id}>
                                    {nama_lab}
                                </option>
                            ))}
                        </SelectInput>
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Dosen"
                            name="id_dosen"
                            errors={errors.id_dosen}
                            value={values.id_dosen}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            {dosen.map(({ id, nama_dosen }) => (
                                <option key={id} value={id}>{nama_dosen}</option>
                            ))}
                        </SelectInput>
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Mata Kuliah"
                            name="id_matkul"
                            errors={errors.id_matkul}
                            value={values.id_matkul}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            {matakuliah.map(({ id, nama_matkul }) => (
                                <option key={id} value={id}>{nama_matkul}</option>
                            ))}
                        </SelectInput>
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/3"
                            label="Tanggal"
                            name="tanggal"
                            type="date"
                            errors={errors.tanggal}
                            value={values.tanggal}
                            onChange={handleChange}
                        />
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/3"
                            label="Jam Pinjam"
                            name="jam_pinjam"
                            type="time"
                            errors={errors.jam_pinjam}
                            value={values.jam_pinjam}
                            onChange={handleChange}
                        />
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/3"
                            label="Jam Kembali"
                            name="jam_kembali"
                            type="time"
                            errors={errors.jam_kembali}
                            value={values.jam_kembali}
                            onChange={handleChange}
                        />
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/3"
                            label="Kategori"
                            name="kategori"
                            errors={errors.kategori}
                            value={values.kategori}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            <option value="didalam_jam">Didalam Jam Kuliah</option>
                            <option value="diluar_jam">Diluar Jam Kuliah</option>
                        </SelectInput>
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/3"
                            label="Proses"
                            name="proses"
                            errors={errors.proses}
                            onChange={handleChange}
                            value={values.proses}
                        >
                            <option></option>
                            <option value="1">Menunggu Persetujuan</option>
                        </SelectInput>
                        <SelectInput
                            className="pr-6 pb-8 w-full lg:w-1/3"
                            label="Status"
                            name="status"
                            errors={errors.status}
                            onChange={handleChange}
                            value={values.status}
                        >
                            <option></option>
                            <option value="0">Masih Dipinjam</option>
                        </SelectInput>
                        <div className="pr-6 pb-8 w-full lg:w-full">
                            <label className="form-label" htmlFor="keperluan">
                                {"Keperluan"}:
                            </label>
                            <textarea name="keperluan" id="keperluan"
                                      className={`form-input ${errors.length ? 'error' : ''}`}
                                      onChange={handleChange}
                                      autoComplete='off'
                                      value={values.keperluan}
                            >
                            </textarea>
                            {errors && <div className="form-error">{errors[0]}</div>}
                        </div>
                    </div>
                    <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                        <InertiaLink
                            href={route('PeminjamanLab.index')}
                            className="text-indigo-600 hover:text-indigo-700 ml-auto mr-6"
                            as="a"
                        >
                            Kembali
                        </InertiaLink>
                        <LoadingButton
                            loading={sending}
                            type="submit"
                            className="btn-indigo"
                        >
                            Tambah Data
                        </LoadingButton>
                    </div>
                </form>
            </div>
        </React.Fragment>
    );
};

// Persisten layout
// Docs: https://inertiajs.com/pages#persistent-layouts
Create.layout = page => <AdminLayout title="Labkom FMIPA UNS | Peminjaman Lab | Tambah Data" children={page} />;

export default Create;
