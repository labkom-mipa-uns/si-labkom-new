import React from 'react';
import AdminLayout from '@/Shared/AdminLayout';

const Dashboard = () => {
    return (
        <React.Fragment>
            <h1 className="mb-8 font-bold text-3xl">Dashboard</h1>
            <p className="mb-12 leading-normal">
                Hey there! Welcome to Labkom's Information System, a
                <a className="text-indigo-600 underline hover:text-orange-500 mx-1"
                    href="https://laravel.com"
                >
                    Laravel
                </a>
                app designed to help how
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
        </React.Fragment>
    );
};

// Persisten layout
// Docs: https://inertiajs.com/pages#persistent-layouts
Dashboard.layout = page => <AdminLayout title="Dashboard" children={page} />;

export default Dashboard;
