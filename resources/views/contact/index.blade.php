@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-lg-5">

                    <h2 class="mb-1">Contact Us</h2>
                    <p class="text-muted mb-4">Have a question or feedback? We'd love to hear from you.</p>

                    <div id="successAlert" class="alert alert-success d-none">
                        <i class="bi bi-check-circle"></i> Your message has been sent successfully!
                    </div>

                    <form id="contactForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="John Doe"
                                        required
                                    >
                                </div>
                                <div class="text-danger small mt-1 error-name"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="you@example.com"
                                        required
                                    >
                                </div>
                                <div class="text-danger small mt-1 error-email"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Subject</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-chat-left-text"></i></span>
                                <input
                                    type="text"
                                    name="subject"
                                    class="form-control"
                                    placeholder="What is this about?"
                                    required
                                >
                            </div>
                            <div class="text-danger small mt-1 error-subject"></div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea
                                name="message"
                                class="form-control rounded-3"
                                rows="6"
                                placeholder="Write your message here..."
                                required
                            ></textarea>
                            <div class="text-danger small mt-1 error-message"></div>
                        </div>

                        <button type="submit" class="btn btn-accent px-5 py-2 fw-semibold" id="submitBtn">
                            <i class="bi bi-send"></i> Send Message
                        </button>
                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="sidebar-widget">
                <h5><i class="bi bi-info-circle"></i> Get In Touch</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex gap-3">
                        <i class="bi bi-envelope-fill text-accent fs-5"></i>
                        <div>
                            <strong>Email</strong><br>
                            <small class="text-muted">admin@blog.com</small>
                        </div>
                    </li>
                    <li class="mb-3 d-flex gap-3">
                        <i class="bi bi-clock-fill text-accent fs-5"></i>
                        <div>
                            <strong>Response Time</strong><br>
                            <small class="text-muted">Within 24 hours</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';

            document.querySelectorAll('[class^="error-"]').forEach(el => el.textContent = '');

            const formData = {
                name:    this.querySelector('[name="name"]').value,
                email:   this.querySelector('[name="email"]').value,
                subject: this.querySelector('[name="subject"]').value,
                message: this.querySelector('[name="message"]').value,
            };

            fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(formData)
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('successAlert').classList.remove('d-none');
                        document.getElementById('contactForm').reset();
                    } else if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const el = document.querySelector(`.error-${field}`);
                            if (el) el.textContent = data.errors[field][0];
                        });
                    }

                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-send"></i> Send Message';
                });
        });
    </script>
@endpush
