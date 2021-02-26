import React, { useState } from 'react';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Icon from '@/Shared/Icon';

export default () => {
    const { auth } = usePage().props;
    const [menuOpened, setMenuOpened] = useState(false);
    return (
        <div className="flex items-center justify-between w-full p-4 text-sm bg-white border-b md:py-0 md:px-12 d:text-md">
            <div className="mt-1 mr-4">{auth.user.name}</div>
            <div className="relative">
                <div
                    className="flex items-center cursor-pointer select-none group"
                    onClick={() => setMenuOpened(true)}
                >
                    <div className="mr-1 text-gray-800 whitespace-no-wrap group-hover:text-indigo-600 focus:text-indigo-600">
                        <span>{auth.user.first_name}</span>
                        <span className="ml-1 hidden md:inline">{auth.user.last_name}</span>
                    </div>
                    <Icon
                        className="w-5 h-5 text-gray-800 fill-current group-hover:text-indigo-600 focus:text-indigo-600"
                        name="cheveron-down"
                    />
                </div>
                <div className={menuOpened ? '' : 'hidden'}>
                    <div className="absolute top-0 right-0 left-auto z-20 py-2 mt-8 text-sm whitespace-no-wrap bg-white rounded shadow-xl">
                        <InertiaLink
                            href={route('User.edit', auth.user.id)}
                            className="block px-6 py-2 hover:bg-indigo-600 hover:text-white"
                            as="a"
                        >
                            My Profile
                        </InertiaLink>
                        <InertiaLink
                            href={route('User.index')}
                            className="block px-6 py-2 hover:bg-indigo-600 hover:text-white"
                            as="a"
                        >
                            Manage Users
                        </InertiaLink>
                        <InertiaLink
                            href={route('logout')}
                            className="block px-6 py-2 hover:bg-indigo-600 hover:text-white"
                            method="post"
                            as="a"
                        >
                            Logout
                        </InertiaLink>
                    </div>
                    <div
                        onClick={() => {
                            setMenuOpened(false);
                        }}
                        className="fixed inset-0 z-10 bg-black opacity-25"
                    >
                    </div>
                </div>
            </div>
        </div>
    );
};
