import React from 'react';
import Helmet from 'react-helmet';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Layout from '@/Shared/Layout';
import Icon from '@/Shared/Icon';
import Pagination from '@/Shared/Pagination';
import SearchFilter from '@/Shared/SearchFilter';

export default () => {
    const { jasainstallasi } = usePage().props;
    const { data, links } = jasainstallasi;
    return (
        <Layout>
            <Helmet title="Labkom FMIPA UNS | Jasa Installasi" />
            <div>
                <h1 className="mb-8 font-bold text-3xl">Jasa Installasi</h1>
                <div className="mb-6 flex justify-between items-center">
                    <SearchFilter />
                    <InertiaLink className="btn-indigo" href={route('JasaInstallasi.create')} as="a">
                        <span>Tambah Data</span>
                        <span className="hidden md:inline"> Jasa Installasi</span>
                    </InertiaLink>
                </div>
                <div className="bg-white rounded shadow overflow-x-auto">
                    <table className="w-full whitespace-no-wrap">
                        <thead>
                            <tr className="text-left font-bold">
                                <th className="px-6 pt-5 pb-4">Tanggal</th>
                                <th className="px-6 pt-5 pb-4">Nama</th>
                                <th className="px-6 pt-5 pb-4">Laptop</th>
                                <th className="px-6 pt-5 pb-4">Software</th>
                                <th className="px-6 pt-5 pb-4">#</th>
                            </tr>
                        </thead>
                        <tbody>
                        {data.map(
                            ({ id, tanggal, mahasiswa, laptop, software, deleted_at }) => (
                                <tr
                                    key={id}
                                    className="hover:bg-gray-100 focus-within:bg-gray-100"
                                >
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaInstallasi.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {tanggal}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaInstallasi.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {mahasiswa.nama_mahasiswa}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaInstallasi.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {laptop}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t">
                                        <InertiaLink
                                            href={route('JasaInstallasi.edit', id)}
                                            className="px-6 py-4 flex items-center focus:text-indigo-700"
                                            as="a"
                                        >
                                            {software.nama_software}
                                        </InertiaLink>
                                    </td>
                                    <td className="border-t w-px">
                                        <InertiaLink
                                            tabIndex="-1"
                                            href={route('JasaInstallasi.edit', id)}
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
                                <td className="border-t px-6 py-4" colSpan="5">
                                    No installasi found.
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
