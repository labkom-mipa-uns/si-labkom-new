import React from 'react';
import Helmet from 'react-helmet';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import Icon from '@/Shared/Icon';
import SearchFilter from '@/Shared/SearchFilter';
import Pagination from '@/Shared/Pagination';

const PeminjamanAlat = () => {
    const { peminjamanalat } = usePage().props;
    const { links, data } = peminjamanalat;
    return (
        <div>
            <Helmet title="Labkom FMIPA UNS | Peminjaman Alat" />
            <div>
                <h1 className="mb-8 font-bold text-3xl">Peminjaman Alat</h1>
                <div className="mb-6 flex justify-between items-center">
                    <SearchFilter />
                    <InertiaLink
                        className="btn-indigo"
                        href={route('PeminjamanAlat.create')}
                    >
                        <span>Tambah Data</span>
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
                        {data.map(({ id, mahasiswa, alat, harga, tanggal_pinjam, tanggal_kembali, jam_pinjam, jam_kembali, jumlah_pinjam, status}) => {
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
                                            <span className="text-bold">{mahasiswa.nama_mahasiswa}</span>
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
                                            <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                ${status === '1' ? "bg-green-200 text-green-800" : "bg-red-200 text-red-800"}`}
                                            >{(status === '1' ? 'Dikembalikan' : 'Dipinjam') }</span>
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
        </div>
    );
};

// Persisten layout
// Docs: https://inertiajs.com/pages#persistent-layouts
PeminjamanAlat.layout = page => <Layout children={page} />;

export default PeminjamanAlat;
