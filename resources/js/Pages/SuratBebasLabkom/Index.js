import React from 'react';
import Helmet from 'react-helmet';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import Icon from '@/Shared/Icon';
import Pagination from '@/Shared/Pagination';
import SearchFilter from '@/Shared/SearchFilter';

export default () => {
    const { surat } = usePage().props;
    const { data, links } = surat;
    return (
        <Layout>
            <Helmet title="Labkom FMIPA UNS | Surat Bebas Labkom" />
            <div>
                <h1 className="mb-8 font-bold text-3xl">Surat Bebas Labkom</h1>
                <div className="mb-6 flex justify-between items-center">
                    <SearchFilter />
                    <InertiaLink className="btn-indigo" href={route('SuratBebasLabkom.create')} as="a">
                        <span>Tambah Data</span>
                        <span className="hidden md:inline"> Surat Bebas Labkom</span>
                    </InertiaLink>
                </div>
                <div className="bg-white rounded shadow overflow-x-auto">
                    <table className="w-full whitespace-no-wrap">
                        <thead>
                            <tr className="text-left font-bold">
                                <th className="px-6 pt-5 pb-4">No</th>
                                <th className="px-6 pt-5 pb-4">NIM</th>
                                <th className="px-6 pt-5 pb-4">Nama</th>
                                <th className="px-6 pt-5 pb-4">Prodi</th>
                                <th className="px-6 pt-5 pb-4">Tanggal</th>
                                <th className="px-6 pt-5 pb-4">#</th>
                            </tr>
                        </thead>
                        <tbody>
                        {data.map(
                            ({ id, mahasiswa, tanggal, deleted_at }, index) => (
                                <tr
                                    key={id}
                                    className="hover:bg-gray-100 focus-within:bg-gray-100"
                                >
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('SuratBebasLabkom.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            { index + 1 }
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('SuratBebasLabkom.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {mahasiswa.nim}
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
                                            tabIndex="1"
                                            className="px-6 py-4 flex items-center focus:text-indigo"
                                            as="a"
                                            href={route('SuratBebasLabkom.edit', id)}
                                        >
                                            {mahasiswa.nama_mahasiswa}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('SuratBebasLabkom.edit', id)}
                                            as="a"
                                            className="px-6 py-4 flex items-center focus:text-indigo"
                                        >
                                            {mahasiswa.prodi.nama_prodi}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('SuratBebasLabkom.edit', id)}
                                            as="a"
                                            className="px-6 py-4 flex items-center focus:text-indigo"
                                        >
                                            {tanggal}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t w-px">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('SuratBebasLabkom.edit', id)}
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
                                    No surat found.
                                </td>
                            </tr>
                        )}
                        </tbody>
                    </table>
                </div>
                <Pagination links={links} />
            </div>
        </Layout>
    );
};
