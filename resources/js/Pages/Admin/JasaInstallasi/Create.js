import React, { useState } from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from "@/Shared/SelectInput";

export default () => {
    const { errors, mahasiswa, software } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        id_mahasiswa: '',
        laptop: '',
        kelengkapan: '',
        tanggal: '',
        id_software: '',
        jenis: '',
        keterangan: '',
        jam_ambil: '',
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
        Inertia.post(route('JasaInstallasi.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <AdminLayout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Jasa Installasi | Tambah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('JasaInstallasi.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Jasa Installasi
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
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Laptop"
                                name="laptop"
                                type="text"
                                errors={errors.laptop}
                                value={values.laptop}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Tanggal"
                                name="tanggal"
                                type="date"
                                errors={errors.tanggal}
                                value={values.tanggal}
                                onChange={handleChange}
                            />
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jenis"
                                name="jenis"
                                errors={errors.jenis}
                                value={values.jenis}
                                onChange={handleChange}
                            >
                                <option></option>
                                <option value="install">Install Software</option>
                                <option value="service">Service Hardware</option>
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Software"
                                name="id_software"
                                errors={errors.id_software}
                                value={values.id_software}
                                onChange={handleChange}
                            >
                                <option value="-"></option>
                                {software.map(({ id, nama_software }) => (
                                    <option key={id} value={id}>
                                        {nama_software}
                                    </option>
                                ))}
                            </SelectInput>
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jam Ambil"
                                name="jam_ambil"
                                type="time"
                                errors={errors.jam_ambil}
                                value={values.jam_ambil}
                                onChange={handleChange}
                            />
                            <div className="pr-6 pb-8 w-full lg:w-1/2">
                                <label className="form-label" htmlFor="kelengkapan">
                                    {"Kelengkapan"}:
                                </label>
                                <textarea name="kelengkapan" id="kelengkapan"
                                          className={`form-input ${errors.length ? 'error' : ''}`}
                                          onChange={handleChange}
                                          autoComplete='off'
                                          value={values.kelengkapan}
                                >
                                </textarea>
                                {errors && <div className="form-error">{errors[0]}</div>}
                            </div>
                            <div className="pr-6 pb-8 w-full lg:w-1/2">
                                <label className="form-label" htmlFor="keterangan">
                                    {"Keterangan"}:
                                </label>
                                <textarea name="keterangan" id="keterangan"
                                          className={`form-input ${errors.length ? 'error' : ''}`}
                                          onChange={handleChange}
                                          autoComplete='off'
                                          value={values.keterangan}
                                >
                                </textarea>
                                {errors && <div className="form-error">{errors[0]}</div>}
                            </div>
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                            <InertiaLink
                                href={route('JasaInstallasi.index')}
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
            </div>
        </AdminLayout>
    );
};
