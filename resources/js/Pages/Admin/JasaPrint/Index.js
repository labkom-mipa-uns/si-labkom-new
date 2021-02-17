import React, {useState} from 'react';
import Helmet from 'react-helmet';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import Icon from '@/Shared/Icon';
import Pagination from '@/Shared/Pagination';
import SearchFilter from '@/Shared/SearchFilter';
import TextInput from "@/Shared/TextInput";
import {Inertia} from "@inertiajs/inertia";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";

export default () => {
    const { jasaprint, errors } = usePage().props;
    const { data, links } = jasaprint;
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        tanggal: '',
        bulan: '',
    });

    function handleChange(e) {
        const key = e.target.name;
        const value = e.target.value;
        setValues(values => ({
            ...values,
            [key]: value
        }));
    }

    function handleSubmitDaily(e) {
        e.preventDefault();
        setSending(true);
        Inertia.post(route('JasaPrint.daily_report'), values).then(() => {
            setSending(false);
        });
    }

    function handleSubmitMonthly(e) {
        e.preventDefault();
        setSending(true);
        Inertia.post(route('JasaPrint.monthly_report'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <AdminLayout>
            <Helmet title="Labkom FMIPA UNS | Jasa Print" />
            <div>
                <h1 className="mb-8 font-bold text-3xl">Jasa Print</h1>
                <div className="mb-6 flex justify-between items-center">
                    <SearchFilter />
                    <form onSubmit={handleSubmitDaily} className="inline">
                        <TextInput
                            className="inline"
                            name="tanggal"
                            type="date"
                            errors={errors.tanggal}
                            value={values.tanggal}
                            onChange={handleChange}
                        />
                        <LoadingButton
                            loading={sending}
                            type="submit"
                            className="btn-danger inline"
                        >
                            Daily
                        </LoadingButton>
                    </form>
                    <form onSubmit={handleSubmitMonthly} className="inline">
                        <SelectInput
                            className="inline"
                            name="bulan"
                            errors={errors.bulan}
                            value={values.bulan}
                            onChange={handleChange}
                        >
                            <option value=""></option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </SelectInput>
                        <LoadingButton
                            loading={sending}
                            type="submit"
                            className="btn-danger inline"
                        >
                            Monthly
                        </LoadingButton>
                    </form>
                    <InertiaLink className="btn-indigo" href={route('JasaPrint.create')} as="a">
                        <span>Tambah</span>
                        <span className="hidden md:inline"> Jasa Print</span>
                    </InertiaLink>
                </div>
                <div className="bg-white rounded shadow overflow-x-auto">
                    <table className="w-full whitespace-no-wrap">
                        <thead>
                            <tr className="text-left font-bold">
                                <th className="px-6 pt-5 pb-4">No</th>
                                <th className="px-6 pt-5 pb-4">Jenis Print</th>
                                <th className="px-6 pt-5 pb-4">Harga Print</th>
                                <th className="px-6 pt-5 pb-4">Jumlah Print</th>
                                <th className="px-6 pt-5 pb-4">Tanggal Print</th>
                                <th className="px-6 pt-5 pb-4">#</th>
                            </tr>
                        </thead>
                        <tbody>
                        {data.map(
                            ({ id, jenis_print, harga_print, jumlah_print, tanggal_print, deleted_at }, index) => (
                                <tr
                                    key={id}
                                    className="hover:bg-gray-100 focus-within:bg-gray-100"
                                >
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaPrint.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {index + 1}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaPrint.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {jenis_print}
                                            {deleted_at && (
                                                <Icon
                                                    name="trash"
                                                    className="flex-shrink-0 w-3 h-3 text-gray-400 fill-current ml-2"
                                                />
                                            )}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaPrint.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            Rp.{harga_print}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaPrint.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {jumlah_print}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaPrint.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {tanggal_print}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t w-px">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('JasaPrint.edit', id)}
                                            as="a"
                                            className="px-4 flex items-center"
                                        >
                                            <Icon
                                                name="cheveron-right"
                                                className="block w-6 h-6 text-gray-400 fill-current"
                                            />
                                        </InertiaLink>
                                    </td>
                                </tr>
                            )
                        )}
                        {data.length === 0 && (
                            <tr>
                                <td className="border-t px-6 py-4" colSpan="6">
                                    No data print found.
                                </td>
                            </tr>
                        )}
                        </tbody>
                    </table>
                </div>
                <Pagination links={links} />
            </div>
        </AdminLayout>
    );
};
