import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';

const Create = () => {
    const { mahasiswa, alat, errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        id_mahasiswa: '',
        id_alat: '',
        tanggal_pinjam: '',
        tanggal_kembali: '',
        jam_pinjam: '',
        jam_kembali: '',
        jumlah_pinjam: '',
        keperluan: '',
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
        Inertia.post(route('PeminjamanAlat.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <React.Fragment>
            <h1 className="mb-8 font-bold text-3xl">
                <InertiaLink
                    href={route('PeminjamanAlat.index')}
                    className="text-indigo-600 hover:text-indigo-700"
                    as="a"
                >
                    Peminjaman Alat
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
                            label="Alat"
                            name="id_alat"
                            errors={errors.id_alat}
                            value={values.id_alat}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            {alat.map(({ id, nama_alat }) => (
                                <option key={id} value={id}>
                                    {nama_alat}
                                </option>
                            ))}
                        </SelectInput>
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Tanggal Pinjam"
                            name="tanggal_pinjam"
                            type="date"
                            errors={errors.tanggal_pinjam}
                            value={values.tanggal_pinjam}
                            onChange={handleChange}
                        />
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Tanggal Kembali"
                            name="tanggal_kembali"
                            type="date"
                            errors={errors.tanggal_kembali}
                            value={values.tanggal_kembali}
                            onChange={handleChange}
                        />
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Jam Pinjam"
                            name="jam_pinjam"
                            type="time"
                            errors={errors.jam_pinjam}
                            value={values.jam_pinjam}
                            onChange={handleChange}
                        />
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/2"
                            label="Jam Kembali"
                            name="jam_kembali"
                            type="time"
                            errors={errors.jam_kembali}
                            value={values.jam_kembali}
                            onChange={handleChange}
                        />
                        <TextInput
                            className="pr-6 pb-8 w-full lg:w-1/3"
                            label="Jumlah Pinjam"
                            name="jumlah_pinjam"
                            errors={errors.jumlah_pinjam}
                            value={values.jumlah_pinjam}
                            onChange={handleChange}
                        />
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
                            >
                                {values.keperluan}
                            </textarea>
                            {errors && <div className="form-error">{errors[0]}</div>}
                        </div>
                    </div>
                    <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                        <InertiaLink
                            href={route('PeminjamanAlat.index')}
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
Create.layout = page => <AdminLayout title="Labkom FMIPA UNS | Peminjaman Alat | Tambah Data" children={page} />;

export default Create;

