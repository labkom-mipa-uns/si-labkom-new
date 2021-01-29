import React, { useState } from 'react';
import Helmet from 'react-helmet';
import { Inertia } from '@inertiajs/inertia';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import TextInput from '@/Shared/TextInput';
import SelectInput from "@/Shared/SelectInput";

export default () => {
    const { errors } = usePage().props;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        jenis_print: '',
        harga_print: '',
        jumlah_print: '',
        tanggal_print: '',
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
        Inertia.post(route('JasaPrint.store'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <Layout>
            <div>
                <Helmet title="Labkom FMIPA UNS | Jasa Print | Tambah Data" />
                <h1 className="mb-8 font-bold text-3xl">
                    <InertiaLink
                        href={route('JasaPrint.index')}
                        className="text-indigo-600 hover:text-indigo-700"
                        as="a"
                    >
                        Jasa Print
                    </InertiaLink>
                    <span className="text-indigo-600 font-medium"> /</span> Tambah Data
                </h1>
                <div className="bg-white rounded shadow overflow-hidden max-w-full mb-8">
                    <form onSubmit={handleSubmit}>
                        <div className="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <SelectInput
                                className="pr-6 pb-8 w-1/2"
                                label="Jenis Print"
                                name="jenis_print"
                                errors={errors.jenis_print}
                                value={values.jenis_print}
                                onChange={handleChange}
                            >
                                <option value=""></option>
                                <option value="Hitam Putih">Hitam Putih</option>
                                <option value="Warna">Warna</option>
                                <option value="Warna-full">Warna-full</option>
                            </SelectInput>
                            <TextInput
                                className="pr-6 pb-8 w-1/2"
                                label="Harga Print"
                                name="harga_print"
                                errors={errors.harga_print}
                                value={values.harga_print}
                                onChange={handleChange}
                                type="number"
                                min="0"
                            />
                            <TextInput
                                className="pr-6 pb-8 w-1/2"
                                label="Jumlah Print"
                                name="jumlah_print"
                                errors={errors.jumlah_print}
                                value={values.jumlah_print}
                                onChange={handleChange}
                                type="number"
                                min="0"
                            />
                            <TextInput
                                className="pr-6 pb-8 w-1/2"
                                label="Tanggal Print"
                                name="tanggal_print"
                                type="date"
                                errors={errors.tanggal_print}
                                value={values.tanggal_print}
                                onChange={handleChange}
                            />
                        </div>
                        <div className="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                            <InertiaLink
                                href={route('JasaPrint.index')}
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
