const navbar = document.querySelector("#navbarMenu");
const navbarLinks = document.querySelectorAll(".navbar-nav .nav-link[href^='#']");
let pendingNavbarTarget = null;

navbar?.addEventListener("hidden.bs.collapse", () => {
    if (!pendingNavbarTarget) {
        return;
    }

    const target = pendingNavbarTarget;
    pendingNavbarTarget = null;
    window.history.pushState(null, "", `#${target.id}`);
    target.scrollIntoView({ behavior: "smooth", block: "start" });
});

navbarLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
        const target = document.querySelector(link.getAttribute("href"));

        if (!target) {
            return;
        }

        if (window.matchMedia("(max-width: 991.98px)").matches && navbar?.classList.contains("show")) {
            event.preventDefault();
            pendingNavbarTarget = target;
            bootstrap.Collapse.getOrCreateInstance(navbar).hide();
        }
    });
});

// Wait for the DOM to load to override the inline functions
window.addEventListener('DOMContentLoaded', () => {

    const revealGroups = [
        {
            selector: '#home .hero-badge, #home h1, #home p, #home .mt-4, #home .hero-image, #about .row > div, .parallax-content, #joiners .row > div, .cta-section .container, footer .container',
            style: 'professional',
        },
        {
            selector: '#courses > .container > .text-center, #activities > .container > .text-center, #courses .subject-card, #activities .activity-card, .parallax-two .quote-box',
            style: 'playful',
        },
    ];
    const revealItems = [];

    revealGroups.forEach(({ selector, style }) => {
        document.querySelectorAll(selector).forEach((item) => {
            item.dataset.reveal = style;
            item.style.setProperty('--reveal-delay', `${(revealItems.length % 3) * 100}ms`);
            revealItems.push(item);
        });
    });

    if (revealItems.length > 0 && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        if ('IntersectionObserver' in window) {
            document.documentElement.classList.add('has-scroll-motion');

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });

            revealItems.forEach((item) => revealObserver.observe(item));
        }
    }

    const counters = document.querySelectorAll('.count-up[data-count]');
    if (counters.length > 0) {
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const activeAnimations = new WeakMap();

        if ('IntersectionObserver' in window) {
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    const counter = entry.target;
                    const target = Number(counter.dataset.count);
                    const previousFrame = activeAnimations.get(counter);

                    if (!entry.isIntersecting) {
                        if (previousFrame) {
                            cancelAnimationFrame(previousFrame);
                            activeAnimations.delete(counter);
                        }
                        counter.textContent = '0+';
                        return;
                    }

                    if (prefersReducedMotion) {
                        counter.textContent = `${target}+`;
                        return;
                    }

                    const duration = 1400;
                    const startedAt = performance.now();
                    const animate = (now) => {
                        const progress = Math.min((now - startedAt) / duration, 1);
                        counter.textContent = `${Math.floor(progress * target)}+`;

                        if (progress < 1) {
                            activeAnimations.set(counter, requestAnimationFrame(animate));
                        } else {
                            activeAnimations.delete(counter);
                        }
                    };

                    activeAnimations.set(counter, requestAnimationFrame(animate));
                });
            }, { threshold: 0.5 });

            counters.forEach((counter) => counterObserver.observe(counter));
        } else {
            counters.forEach((counter) => {
                counter.textContent = `${counter.dataset.count}+`;
            });
        }
    }

    const activityIntro = document.getElementById('activitiesIntro');
    const activityList = document.getElementById('activityList');
    const activityPlayground = document.getElementById('activitiesPlayground');
    const activityCategory = document.getElementById('activityCategory');
    const activityTitle = document.getElementById('activityTitle');
    const activityProgress = document.getElementById('activityProgress');
    const activityProgressBar = document.getElementById('activityProgressBar');
    const activityPrompt = document.getElementById('activityPrompt');
    const activityOptions = document.getElementById('activityOptions');
    const activityFeedback = document.getElementById('activityFeedback');
    const activityNext = document.getElementById('activityNext');
    const activityRestart = document.getElementById('activityRestart');

    const quizQuestions = [
        { question: 'How many sides does a triangle have?', options: ['2', '3', '4', '5'], answer: 1 },
        { question: 'Which planet do we live on?', options: ['Mars', 'Earth', 'Jupiter', 'Venus'], answer: 1 },
        { question: 'What do bees make?', options: ['Milk', 'Honey', 'Bread', 'Juice'], answer: 1 },
        { question: 'Which animal is known as the king of the jungle?', options: ['Elephant', 'Tiger', 'Lion', 'Giraffe'], answer: 2 },
        { question: 'How many days are there in a week?', options: ['5', '6', '7', '8'], answer: 2 },
        { question: 'Which one is a source of light?', options: ['The Sun', 'A rock', 'A book', 'A shoe'], answer: 0 },
        { question: 'What is a baby frog called?', options: ['Cub', 'Tadpole', 'Calf', 'Chick'], answer: 1 },
        { question: 'Which sense do we use with our ears?', options: ['Sight', 'Smell', 'Hearing', 'Taste'], answer: 2 },
        { question: 'What is frozen water called?', options: ['Steam', 'Ice', 'Rain', 'Fog'], answer: 1 },
        { question: 'Which shape has no corners?', options: ['Square', 'Triangle', 'Circle', 'Rectangle'], answer: 2 },
    ];

    const puzzleQuestions = [
        { question: 'What is 7 + 5?', options: ['10', '11', '12', '13'], answer: 2 },
        { question: 'What is 15 − 8?', options: ['6', '7', '8', '9'], answer: 1 },
        { question: 'What is 4 × 3?', options: ['7', '10', '12', '14'], answer: 2 },
        { question: 'What comes next: 2, 4, 6, 8, …?', options: ['9', '10', '11', '12'], answer: 1 },
        { question: 'You have 3 apples and get 2 more. How many now?', options: ['4', '5', '6', '7'], answer: 1 },
        { question: 'What is half of 18?', options: ['8', '9', '10', '12'], answer: 1 },
        { question: 'Which number is missing: 5, 10, 15, …, 25?', options: ['18', '19', '20', '21'], answer: 2 },
        { question: 'A square has 4 equal sides. How many corners?', options: ['3', '4', '5', '6'], answer: 1 },
        { question: 'What is 20 ÷ 4?', options: ['4', '5', '6', '8'], answer: 1 },
        { question: 'What is 9 + 8?', options: ['15', '16', '17', '18'], answer: 2 },
        { question: 'Which is the smallest number?', options: ['14', '9', '12', '17'], answer: 1 },
        { question: 'There are 3 birds on a tree. 2 more join. How many?', options: ['4', '5', '6', '7'], answer: 1 },
    ];

    const storyChapters = [
        {
            question: 'Milo finds a tiny map near the garden gate. Where should he explore first?',
            options: [
                { label: '🌳 The whispering forest', ending: 'Milo follows the forest trail and meets a friendly owl who shares a sparkling leaf.' },
                { label: '🌊 The winding river', ending: 'Milo follows the river and helps a duckling find its family. A rainbow appears overhead!' },
            ],
        },
        {
            question: 'A little robot named Beep has lost its way home. What can you do?',
            options: [
                { label: '🧭 Build a compass', ending: 'Your compass points Beep home, and the robot lights up with joy.' },
                { label: '⭐ Follow the stars', ending: 'You and Beep follow the bright stars and discover a safe path together.' },
            ],
        },
        {
            question: 'Nila discovers a seed that glows at night. Where should she plant it?',
            options: [
                { label: '🏡 In the school garden', ending: 'By morning, a beautiful flower has grown. Its petals shine like tiny lanterns.' },
                { label: '⛰️ On the hilltop', ending: 'The glowing flower lights up the hill, helping every traveller find the way.' },
            ],
        },
        {
            question: 'A cloud has lost its colours. How will you help?',
            options: [
                { label: '🎨 Paint a rainbow', ending: 'Your rainbow brings the colours back, and the cloud dances across the sky.' },
                { label: '🎵 Sing a happy song', ending: 'Your song makes the cloud smile. Its colours return with every cheerful note.' },
            ],
        },
        {
            question: 'A tiny dragon is nervous about its first flight. What will you suggest?',
            options: [
                { label: '🪶 Practise with a feather', ending: 'The dragon practises gently and soon glides above the meadow.' },
                { label: '🤝 Fly together', ending: 'With a friend beside it, the dragon takes off and discovers it can soar.' },
            ],
        },
    ];

    const activitySets = {
        quiz: { category: 'BRAIN QUIZ', title: 'Quick Thinkers Quiz', items: quizQuestions, scoreAnswers: true },
        puzzles: { category: 'PUZZLE TIME', title: 'Maths & Logic Puzzles', items: puzzleQuestions, scoreAnswers: true },
        stories: { category: 'STORY TIME', title: 'Choose Your Adventure', items: storyChapters, scoreAnswers: false },
    };

    let currentActivity = null;
    let currentActivityIndex = 0;
    let currentActivityScore = 0;
    let hasAnsweredActivity = false;
    let activeActivityTrigger = null;

    const updateActivityProgress = () => {
        const total = currentActivity.items.length;
        activityProgress.textContent = `Round ${currentActivityIndex + 1} of ${total}${currentActivity.scoreAnswers ? ` · Score ${currentActivityScore}` : ''}`;
        activityProgressBar.style.width = `${((currentActivityIndex + 1) / total) * 100}%`;
    };

    const finishActivity = () => {
        const isStory = !currentActivity.scoreAnswers;
        activityCategory.textContent = isStory ? 'ADVENTURE COMPLETE' : 'ACTIVITY COMPLETE';
        activityTitle.textContent = isStory ? 'What a lovely adventure!' : 'Brilliant work!';
        activityProgress.textContent = isStory
            ? `You explored ${currentActivity.items.length} story chapters.`
            : `You scored ${currentActivityScore} out of ${currentActivity.items.length}!`;
        activityProgressBar.style.width = '100%';
        activityPrompt.textContent = isStory ? 'Ready for another story journey?' : 'Want to try again and beat your score?';
        activityOptions.replaceChildren();
        activityFeedback.textContent = isStory ? 'Thanks for helping every character find a happy ending! ✨' : 'Keep practising — every try makes your brain stronger! 🌟';
        activityFeedback.className = 'activity-feedback is-correct';
        activityNext.hidden = true;
        activityRestart.hidden = false;
    };

    const renderActivityQuestion = () => {
        const item = currentActivity.items[currentActivityIndex];
        hasAnsweredActivity = false;
        activityTitle.textContent = currentActivity.title;
        activityCategory.textContent = currentActivity.category;
        activityPrompt.textContent = item.question;
        activityFeedback.textContent = '';
        activityFeedback.className = 'activity-feedback';
        activityNext.hidden = true;
        activityRestart.hidden = true;
        activityOptions.replaceChildren();
        updateActivityProgress();

        const options = currentActivity.scoreAnswers
            ? item.options.map((label, index) => ({ label, index }))
            : item.options.map((option, index) => ({ label: option.label, ending: option.ending, index }));

        options.forEach((option) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'activity-option';
            button.textContent = option.label;
            button.addEventListener('click', () => {
                if (hasAnsweredActivity) {
                    return;
                }

                hasAnsweredActivity = true;
                const isCorrect = currentActivity.scoreAnswers && option.index === item.answer;
                activityOptions.querySelectorAll('button').forEach((choice) => {
                    choice.disabled = true;
                });

                if (currentActivity.scoreAnswers) {
                    if (isCorrect) {
                        currentActivityScore += 1;
                        button.classList.add('is-correct');
                        activityFeedback.textContent = 'That’s right! Great thinking! ⭐';
                        activityFeedback.className = 'activity-feedback is-correct';
                    } else {
                        activityOptions.children[item.answer]?.classList.add('is-correct');
                        button.classList.add('is-incorrect');
                        activityFeedback.textContent = `Nice try! The answer is ${item.options[item.answer]}.`;
                        activityFeedback.className = 'activity-feedback is-incorrect';
                    }
                    updateActivityProgress();
                } else {
                    activityFeedback.textContent = option.ending;
                    activityFeedback.className = 'activity-feedback is-correct';
                }

                activityNext.hidden = false;
                activityNext.textContent = currentActivityIndex === currentActivity.items.length - 1
                    ? (currentActivity.scoreAnswers ? 'See score →' : 'Finish story →')
                    : (currentActivity.scoreAnswers ? 'Next question →' : 'Next story →');
            });
            activityOptions.append(button);
        });
    };

    document.querySelectorAll('[data-activity-start]').forEach((button) => {
        button.addEventListener('click', () => {
            activeActivityTrigger = button;
            currentActivity = activitySets[button.dataset.activityStart];
            currentActivityIndex = 0;
            currentActivityScore = 0;
            activityIntro.hidden = true;
            activityList.hidden = true;
            activityPlayground.hidden = false;
            renderActivityQuestion();
            activityBackButton.focus({ preventScroll: true });
        });
    });

    const activityBackButton = document.querySelector('[data-activity-back]');
    activityBackButton?.addEventListener('click', () => {
        activityPlayground.hidden = true;
        activityList.hidden = false;
        activityIntro.hidden = false;
        activeActivityTrigger?.focus({ preventScroll: true });
    });

    activityNext?.addEventListener('click', () => {
        if (currentActivityIndex >= currentActivity.items.length - 1) {
            finishActivity();
            return;
        }

        currentActivityIndex += 1;
        renderActivityQuestion();
    });

    activityRestart?.addEventListener('click', () => {
        currentActivityIndex = 0;
        currentActivityScore = 0;
        renderActivityQuestion();
    });

    // Format Date Dropdown Options
    const dateSelect = document.getElementById('dateSelect');
    if (dateSelect) {
        const options = dateSelect.options;
        const today = new Date();
        const formatDate = (date) => {
            return date.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
        };
        for (let i = 0; i < options.length; i++) {
            if (options[i].value === 'today' || options[i].value.startsWith('Today')) {
                const formatted = `Today (${formatDate(today)})`;
                options[i].text = formatted;
                options[i].value = formatted;
            } else if (options[i].value === 'tomorrow' || options[i].value.startsWith('Tomorrow')) {
                const tmrw = new Date(today);
                tmrw.setDate(today.getDate() + 1);
                const formatted = `Tomorrow (${formatDate(tmrw)})`;
                options[i].text = formatted;
                options[i].value = formatted;
            } else if (options[i].value === 'day_after' || options[i].value.startsWith('Day After')) {
                const dayAfter = new Date(today);
                dayAfter.setDate(today.getDate() + 2);
                const formatted = `Day After Tomorrow (${formatDate(dayAfter)})`;
                options[i].text = formatted;
                options[i].value = formatted;
            }
        }
    }

    // Helper function to safely extract values
    const safeVal = (id) => {
        const el = document.getElementById(id);
        return el ? el.value : '';
    };

    let scheduledDemoAt = null;
    let demoCountdownInterval = null;
    const demoModalElement = document.getElementById('demoModal');

    const updateDemoConfirmation = () => {
        const childName = safeVal('childName').trim().split(/[,&]/)[0].trim() || 'Your child';
        const courseSelect = document.getElementById('courseSelect');
        const selectedCourse = courseSelect?.selectedOptions[0]?.textContent.trim() || 'your chosen course';
        const dateSelect = document.getElementById('dateSelect');
        const timeValue = safeVal('timeSelect');
        const preferredDay = (dateSelect?.value || '').toLowerCase();
        const bookingDate = new Date();

        if (preferredDay.startsWith('tomorrow')) {
            bookingDate.setDate(bookingDate.getDate() + 1);
        } else if (preferredDay.startsWith('day after') || preferredDay.startsWith('day_after')) {
            bookingDate.setDate(bookingDate.getDate() + 2);
        }

        const [hours = 0, minutes = 0] = timeValue.split(':').map(Number);
        bookingDate.setHours(hours, minutes, 0, 0);
        scheduledDemoAt = bookingDate;

        const ordinal = (day) => {
            const remainder = day % 100;
            const suffix = remainder >= 11 && remainder <= 13 ? 'th' : ({ 1: 'st', 2: 'nd', 3: 'rd' }[day % 10] || 'th');
            return `${day}${suffix}`;
        };

        const weekday = bookingDate.toLocaleDateString('en-IN', { weekday: 'short' });
        const month = bookingDate.toLocaleDateString('en-IN', { month: 'short' });
        const twelveHour = hours % 12 || 12;
        const meridiem = hours >= 12 ? 'PM' : 'AM';
        const formattedTime = `${twelveHour}:${String(minutes).padStart(2, '0')} ${meridiem}`;
        const teacherPreference = document.querySelector('input[name="teacherPref"]:checked')?.value;

        const demoCopy = window.demoPageCopy || {};
        document.getElementById('demoSuccessTitle').textContent = (demoCopy.successDynamicTitle || 'See you in class — :child’s demo is booked!').replace(':child', childName);
        document.getElementById('demoSuccessWeekday').textContent = weekday;
        document.getElementById('demoSuccessDate').textContent = `${ordinal(bookingDate.getDate())} ${month}`;
        document.getElementById('demoSuccessTime').textContent = formattedTime;
        document.getElementById('demoSuccessCourse').textContent = selectedCourse;
        document.getElementById('demoSuccessClassType').textContent = teacherPreference === 'group'
            ? (demoCopy.groupClassTitle || 'Interactive group class with an expert teacher')
            : (demoCopy.oneToOneClassTitle || 'Live 1:1 class with an expert teacher');

        const countdownElement = document.getElementById('demoCountdown');
        const updateCountdown = () => {
            const remainingSeconds = Math.max(0, Math.floor((scheduledDemoAt.getTime() - Date.now()) / 1000));
            if (remainingSeconds === 0) {
                countdownElement.textContent = demoCopy.countdownNow || 'Your demo is starting now!';
                window.clearInterval(demoCountdownInterval);
                demoCountdownInterval = null;
                return;
            }

            const days = Math.floor(remainingSeconds / 86400);
            const hoursRemaining = Math.floor((remainingSeconds % 86400) / 3600);
            const minutesRemaining = Math.floor((remainingSeconds % 3600) / 60);
            const secondsRemaining = remainingSeconds % 60;
            const dayLabel = days > 0 ? `${days}d ` : '';
            countdownElement.textContent = `${dayLabel}${String(hoursRemaining).padStart(2, '0')}:${String(minutesRemaining).padStart(2, '0')}:${String(secondsRemaining).padStart(2, '0')}`;
        };

        window.clearInterval(demoCountdownInterval);
        updateCountdown();
        demoCountdownInterval = window.setInterval(updateCountdown, 1000);
    };

    demoModalElement?.addEventListener('hidden.bs.modal', () => {
        window.clearInterval(demoCountdownInterval);
        demoCountdownInterval = null;
        scheduledDemoAt = null;
    });

    // Override submitDemoForm
    window.submitDemoForm = function() {
        const parentName = document.getElementById('parentName');
        const childName = document.getElementById('childName');
        const mobile = document.getElementById('MobileNumber');

        if (!parentName.checkValidity()) {
            parentName.reportValidity();
            return;
        }
        if (!mobile || !mobile.checkValidity()) {
            if(mobile) mobile.reportValidity();
            return;
        }
        if (!childName.checkValidity()) {
            childName.reportValidity();
            return;
        }

        // Gather form data
        const formData = new FormData();
        formData.append('course', safeVal('courseSelect'));
        formData.append('teacherPref', document.querySelector('input[name="teacherPref"]:checked')?.value || '');
        formData.append('feedback', document.querySelector('#demoStep2 textarea')?.value || '');
        formData.append('classSelect', safeVal('classSelect'));
        formData.append('dateSelect', safeVal('dateSelect'));
        formData.append('timeSelect', safeVal('timeSelect'));
        formData.append('emailInput', safeVal('demoEmailInput'));
        formData.append('parentName', parentName.value);
        formData.append('mobile', mobile ? mobile.value : '');
        formData.append('childName', childName.value);

        // Fetch API call
        fetch('/book-demo', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            }
        })
        .then(async response => {
            if (!response.ok) {
                const responseText = await response.text();
                const demoCopy = window.demoPageCopy || {};
                let message = (demoCopy.httpErrorMessage || 'Booking failed (HTTP :status).').replace(':status', response.status);
                try {
                    const errorData = JSON.parse(responseText);
                    message = errorData.message || Object.values(errorData.errors || {}).flat()[0] || message;
                } catch (error) {
                    console.error('The demo booking endpoint returned a non-JSON error.', error, responseText);
                    if (response.status >= 500) message = demoCopy.serverErrorMessage || 'The server could not save the booking. Check the service logs and database connection.';
                }
                throw new Error(message);
            }
            return response.json();
        })
        .then(data => {
            updateDemoConfirmation();
            document.getElementById('demoForm').classList.add('d-none');
            document.getElementById('successMessage').classList.remove('d-none');
            const demoCopy = window.demoPageCopy || {};
            document.getElementById('demoModalLabel').textContent = demoCopy.confirmedFormTitle || 'Booking Confirmed';
            document.getElementById('demoModalSubtitle').textContent = demoCopy.confirmedFormDescription || 'Here’s what happens next';
            document.getElementById('demoProgress').classList.add('d-none');
        })
        .catch(error => {
            console.error('Error:', error);
            const demoCopy = window.demoPageCopy || {};
            if(typeof showAlert === 'function') showAlert(demoCopy.submitErrorTitle || 'Booking not submitted', error.message || demoCopy.submitErrorMessage || 'Please check your details and try again.');
        });
    };

    // Override submitApplication
    window.submitApplication = function() {
        const resume = document.getElementById('resumeFile');
        
        if (!resume.checkValidity()) {
            resume.reportValidity();
            return;
        }

        const selectedResume = resume.files[0];
        if (!selectedResume || selectedResume.size < 1024 || selectedResume.size > 20 * 1024 * 1024) {
            if (typeof showAlert === 'function') {
                showAlert(window.teacherPageCopy?.submitErrorTitle || 'Error', window.teacherPageCopy?.resumeSizeError || 'Choose a PDF between 1 KB and 20 MB.');
            }
            return;
        }

        const formData = new FormData();
        formData.append('firstNameInput', safeVal('firstNameInput'));
        formData.append('phoneInput', safeVal('phoneInput'));
        formData.append('emailInput', safeVal('emailInput'));
        formData.append('fullNameInput', safeVal('fullNameInput'));
        formData.append('genderSelect', safeVal('genderSelect'));
        formData.append('ageInput', safeVal('ageInput'));
        formData.append('qualificationInput', safeVal('qualificationInput'));
        formData.append('degreeInput', safeVal('degreeInput'));
        formData.append('experience', safeVal('experienceInput'));

        // Collect certificates
        const certs = [];
        if(document.getElementById('certTESOL')?.checked) certs.push('TESOL');
        if(document.getElementById('certTOFFL')?.checked) certs.push('TOEFL');
        if(document.getElementById('certCET')?.checked) certs.push('CET');
        if(document.getElementById('certCLT')?.checked) certs.push('CLT');
        if(document.getElementById('certCECT')?.checked) certs.push('CECT');
        if(document.getElementById('certCELTA')?.checked) certs.push('CELTA');
        
        const otherCerts = document.querySelector('#teacherStep5 input[type="text"]')?.value || '';
        if(otherCerts) certs.push(otherCerts);

        certs.forEach(cert => formData.append('certifications[]', cert));
        
        if (resume.files.length > 0) {
            formData.append('resumeFile', resume.files[0]);
        }

        // Fetch API call
        fetch('/teacher-login', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            }
        })
        .then(async response => {
            if (!response.ok) {
                const teacherCopy = window.teacherPageCopy || {};
                let errorMessage = teacherCopy.submitErrorMessage || 'The application could not be submitted. Please try again.';
                const responseText = await response.text();
                try {
                    // PHP startup warnings can precede Laravel's JSON response.
                    const jsonStart = responseText.lastIndexOf('{"message"');
                    const errorData = JSON.parse(jsonStart >= 0 ? responseText.slice(jsonStart) : responseText);
                    errorMessage = errorData.message || Object.values(errorData.errors || {}).flat()[0] || errorMessage;
                } catch (error) {
                    console.error('The server returned an unreadable application error.', error, responseText);
                }
                throw new Error(errorMessage);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('teacherFormCard').classList.add('d-none');
            document.getElementById('teacherProgressBar').parentElement.classList.add('d-none');
            document.getElementById('teacherSuccessMessage').classList.remove('d-none');
        })
        .catch(error => {
            console.error('Error:', error);
            if(typeof showAlert === 'function') showAlert(window.teacherPageCopy?.submitErrorTitle || 'Error', error.message || window.teacherPageCopy?.submitErrorLater || 'Failed to submit application. Please try again later.');
        });
    };
});
