import React, { useState } from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from '@/Shared/SelectInput';

export default () => {
    const { prodi, errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        nama_mahasiswa: '',
        nim: '',
        jenis_kelamin: '',
        kelas: '',
        id_prodi: '',
        angkatan: '',
        no_hp: '',
        email: '',
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
        Inertia.post(route('Mahasiswa.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <Layout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Mahasiswa | Tambah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('Mahasiswa.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Mahasiswa
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium"> /</span> Tambah Data
                </h1>
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="NIM"
                                name="nim"
                                errors={errors.nim}
                                value={values.nim}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Nama Lengkap"
                                name="nama_mahasiswa"
                                errors={errors.nama_mahasiswa}
                                value={values.nama_mahasiswa}
                                onChange={handleChange}
                            />
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Program Studi"
                                name="id_prodi"
                                errors={errors.id_prodi}
                                value={values.id_prodi}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                {prodi.map(({ id, nama_prodi }) => (
                                    <option key={id} value={id}>
                                        {nama_prodi}
                                    </option>
                                ))}
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Tahun Angkatan"
                                name="angkatan"
                                errors={errors.angkatan}
                                value={values.angkatan}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </SelectInput>
                            <SelectInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Jenis Kelamin"
                                name="jenis_kelamin"
                                errors={errors.jenis_kelamin}
                                value={values.jenis_kelamin}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </SelectInput>
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Kelas"
                                name="kelas"
                                type="text"
                                errors={errors.kelas}
                                value={values.kelas}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="No WhatsApp"
                                name="no_hp"
                                type="tel"
                                errors={errors.no_hp}
                                value={values.no_hp}
                                onChange={handleChange}
                            />
                            <TextInput
                                className="pr-6 pb-8 w-full lg:w-1/2"
                                label="Email"
                                name="email"
                                type="email"
                                errors={errors.email}
                                value={values.email}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                            <InertiaLink
                                href={route('Mahasiswa.index')}
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
        </Layout>
    );
};
