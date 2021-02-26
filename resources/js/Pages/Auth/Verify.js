import React, {useState} from 'react'
import {Inertia} from "@inertiajs/inertia";

export default () => {
    const [sending, setSending] = useState(false);
    const [values, setValues] = useState({
        verify: true
    });

    function handleSubmit(e) {
        e.preventDefault();
        setSending(true);
        Inertia.post(route('verification.resend'), values, {
            onFinish: () => setSending(false)
        });
    }

    function handleClick(e) {
        e.preventDefault();
        document.getElementById('resend-verification-form').submit();
    }

    return (
        <div className="flex flex-col items-center justify-center min-h-screen p-6 bg-indigo-900">
            <div className="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100  px-3 py-4 mb-4"
                 role="alert">
                { 'A fresh verification link has been sent to your email address.' }
            </div>

            <section className="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
                <header className="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    { 'Verify Your Email Address' }
                </header>

                <div className="w-full flex flex-col flex-wrap text-gray-700 leading-normal text-sm p-6 space-y-4 sm:text-base sm:space-y-6">
                    <p>
                        { 'Before proceeding, please check your email for a verification link.' }
                    </p>

                    <p>
                        { 'If you did not receive the email' }, <a
                        className="text-blue-500 hover:text-blue-700 no-underline hover:underline cursor-pointer"
                        onClick={handleClick}>{ 'click here to request another' }</a>.
                    </p>

                    <form id="resend-verification-form" onSubmit={handleSubmit}
                          className="hidden">
                    </form>
                </div>
            </section>
        </div>
    )
}
