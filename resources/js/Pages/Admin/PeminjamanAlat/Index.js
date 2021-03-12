import React, {useState} from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import AdminLayout from '@/Shared/AdminLayout';
import Icon from '@/Shared/Icon';
import SearchFilter from '@/Shared/SearchFilter';
import Pagination from '@/Shared/Pagination';
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";
import SelectInput from "@/Shared/SelectInput";
import {Inertia} from "@inertiajs/inertia";

const Index = () => {
    const { peminjamanalat, errors } = usePage().props;
    const { links, data } = peminjamanalat;
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
        Inertia.post(route('PeminjamanAlat.daily_report'), values).then(() => {
            setSending(false);
        });
    }

    function handleSubmitMonthly(e) {
        e.preventDefault();
        setSending(true);
        Inertia.post(route('PeminjamanAlat.monthly_report'), values).then(() => {
            setSending(false);
        });
    }

    return (
        <React.Fragment>
            <div>
                <h1 className="mb-8 font-bold text-3xl">Peminjaman Alat</h1>
                <div className="mb-6 flex justify-between items-center">
                    <SearchFilter />
                    <form onSubmit={handleSubmitDaily} className="flex flex-row items-center">
                        <TextInput
                            name="tanggal"
                            type="date"
                            errors={errors.tanggal}
                            value={values.tanggal}
                            onChange={handleChange}
                        />
                        <LoadingButton
                            loading={sending}
                            type="submit"
                            className="btn-danger ml-3"
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
                    <InertiaLink
                        className="btn-indigo"
                        href={route('PeminjamanAlat.create')}
                    >
                        <span>Tambah</span>
                        <span className="hidden md:inline"> Peminjam Alat</span>
                    </InertiaLink>
                </div>
                <div className="bg-white rounded shadow overflow-x-auto">
                    <table className="w-full table-auto">
                        <thead>
                        <tr className="text-left font-bold">
                            <th className="px-6 pt-5 pb-4 lg:text-center">Nama</th>
                            <th className="px-6 pt-5 pb-4 lg:text-center">Prodi</th>
                            <th className="px-6 pt-5 pb-4 lg:text-center">Alat</th>
                            <th className="px-6 pt-5 pb-4 lg:text-center">Waktu</th>
                            <th className="px-6 pt-5 pb-4 lg:text-center">Status</th>
                            <th className="px-6 pt-5 pb-4 lg:text-center">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        {data.map(({ id, mahasiswa, alat, harga, tanggal_pinjam, tanggal_kembali, jam_pinjam, jam_kembali, jumlah_pinjam, proses, status}) => {
                            return (
                                <tr
                                    key={id}
                                    className="hover:bg-gray-100 focus-within:bg-gray-100"
                                >
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('PeminjamanAlat.edit', id)}
                                            className="px-6 py-4 flex flex-col items-center lg:text-center focus:text-indigo-700"
                                        >
                                            <span className="font-bold">{mahasiswa.nama_mahasiswa}</span>
                                            <span className="text-sm text-gray-700">{mahasiswa.nim}</span>
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('PeminjamanAlat.edit', id)}
                                            className="px-6 py-4 flex flex-col items-center lg:text-center focus:text-indigo"
                                        >
                                            <span className='font-bold'>{mahasiswa.prodi.nama_prodi}</span>
                                            <span className='text-sm text-gray-700'>{mahasiswa.angkatan}</span>
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('PeminjamanAlat.edit', id)}
                                            className="px-6 py-4 flex flex-col items-center lg:text-center focus:text-indigo"
                                        >
                                            <span className='font-bold'>{alat.nama_alat}</span>
                                            <span className='text-sm text-gray-700'>Rp.{harga} × {jumlah_pinjam}</span>
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('PeminjamanAlat.edit', id)}
                                            className="px-6 py-4 flex flex-col items-center lg:text-center focus:text-indigo"
                                        >
                                            <span className='font-bold'>{tanggal_pinjam} - {tanggal_kembali}</span>
                                            <span className='text-sm text-gray-700'>{jam_pinjam} - {jam_kembali}</span>
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('PeminjamanAlat.edit', id)}
                                            className="px-6 py-4 flex flex-col items-center lg:text-center focus:text-indigo"
                                        >
                                            {proses !== '1' && (
                                                <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                ${status === '1' ? "bg-green-200 text-green-800" : "bg-red-200 text-red-800"}`}
                                                >{(status === '1' ? 'Dikembalikan' : 'Dipinjam') }</span>
                                            )}
                                            {proses === '1' && (
                                                <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    ${proses === '1' ? "bg-yellow-200 text-yellow-800" : "bg-green-200 text-yellow-800"}`}
                                                >{(proses === '1' ? 'Menunggu Persetujuan' : 'Disetujui') }</span>
                                            )}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t w-px">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('PeminjamanAlat.edit', id)}
                                            className="px-4 flex items-center"
                                        >
                                            <Icon
                                                name="cheveron-right"
                                                className="block w-6 h-6 text-gray-400 fill-current"
                                            />
                                        </InertiaLink>
                                    </td>
                                </tr>
                            );
                        })}
                        {data.length === 0 && (
                            <tr>
                                <td className="border-t px-6 py-4" colSpan="7">
                                    No peminjam alat found.
                                </td>
                            </tr>
                        )}
                        </tbody>
                    </table>
                </div>
                <Pagination links={links} />
            </div>
        </React.Fragment>

    );
};

// Persisten layout
// Docs: https://inertiajs.com/pages#persistent-layouts
Index.layout = page => <AdminLayout title="Labkom FMIPA UNS | Peminjaman Alat" children={page} />;

export default Index;
