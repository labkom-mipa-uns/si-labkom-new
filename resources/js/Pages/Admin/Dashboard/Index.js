import React from 'react';
import Helmet from 'react-helmet';
import AdminLayout from '@/Shared/AdminLayout';

const Dashboard = () => {
    return (
        <div>
            <Helmet>
                <title>Dashboard</title>
            </Helmet>
            <h1 className="mb-8 font-bold text-3xl">Dashboard</h1>
            <p className="mb-12 leading-normal">
                Sistem Informasi Labkom FMIPA UNS
                <a
                    className="text-indigo-600 underline hover:text-orange-500 mx-1"
                    href="https://inertiajs.com"
                >
                    Inertia.js
                </a>
                works with
                <a
                    className="text-indigo-600 underline hover:text-orange-500 ml-1"
                    href="https://reactjs.org/"
                >
                    React
                </a>
                .
            </p>
        </div>
    );
};

// Persisten layout
// Docs: https://inertiajs.com/pages#persistent-layouts
Dashboard.layout = page => <AdminLayout children={page} />;

export default Dashboard;
