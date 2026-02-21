@extends('site.layouts.app')

@section('title', 'Vicente Silva - FullStack Developer')

@section('content')
    <div id="home"></div>

    <section class="relative w-full h-screen flex justify-end items-center px-[5%] md:px-[10%] text-white overflow-hidden">
        <div class="absolute inset-0 z-[-1]">
            <img class="w-full h-full object-cover object-[25%_75%]" src="{{ asset('assets/vicentebanner.png') }}" alt="Banner Vicente">
            <div class="absolute inset-0 bg-black/40"></div> </div>

        <div class="reveal w-full flex flex-col items-end z-10">
            <h1 class="text-4xl md:text-6xl lg:text-8xl font-bold drop-shadow-lg">Vicente Silva</h1>
            <p class="text-sm md:text-2xl lg:text-4xl drop-shadow-md mt-2">Desenvolvedor Web FullStack</p>
            
            <div class="grid sm:grid-cols-2 gap-5 mt-8 w-full max-w-lg">
                <div class="flex gap-5 w-full justify-end sm:justify-start items-center">
                    <a href="https://www.youtube.com/@VicenteDeveloper" target="_blank" class="hover:text-red-500 hover:scale-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/></svg>
                    </a>
                    <a href="https://github.com/VicenteAlef" target="_blank" class="hover:text-gray-400 hover:scale-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/in/vicente-da-silva-57a0a1341" target="_blank" class="hover:text-blue-500 hover:scale-110 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/></svg>
                    </a>
                </div>

                <a href="{{ asset('assets/CurriculoVicente.pdf') }}" download="Curriculo_Vicente_Silva.pdf" class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 px-5 py-3 rounded-xl transition-colors font-semibold">
                    Baixar Currículo
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/></svg>
                </a>
            </div>
        </div>
    </section>

    <div class="w-full bg-gray-950 px-4 md:px-[10%] xl:px-[15%] py-20">
        
        <section id="about" class="mb-32 pt-16">
            <div class="reveal">
                <h2 class="text-4xl mb-8 font-bold">Sobre mim</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                    <div class="p-6 sm:p-10 bg-gray-900 rounded-xl border border-gray-800 shadow-lg flex flex-col gap-5 text-gray-300 leading-relaxed text-justify h-full">
                        <p>
                            Sou Ildealef H. Vicente da Silva, brasiliense de 28 anos, apaixonadíssimo por tecnologia desde garoto. Como estudante de Engenharia de Software, tenho o objetivo de me tornar o melhor e mais competente profissional do mercado. A ideia de solucionar problemas, automatizar tarefas, elevar o nível de negócios, tudo isso utilizando da tecnologia, é definitivamente algo que me empolga muito.
                        </p>
                        <p>
                            O meu contato com a programação antecede a minha matrícula no curso de Engenharia de Software. Tudo começou com OutSystems, uma linguagem de programação lowcode que permite desenvolver aplicações web e mobile de forma muito rápida... Não levou muito tempo para acabar me interessando pelo desenvolvimento Web Tradicional, o que naturalmente me levou ao desenvolvimento frontend com React.js. E não satisfeito, acabei expandindo meus conhecimentos para o desenvolvimento back-end, me tornando assim, um desenvolvedor fullstack.
                        </p>
                    </div>

                    <div class="flex flex-col gap-6 h-full">
                        <div class="p-6 sm:p-10 bg-gray-900 rounded-xl border border-gray-800 shadow-lg flex-1">
                            <p class="mb-5 text-gray-300">Dentre as minhas habilidades e conhecimentos você encontra:</p>
                            <ul class="list-disc pl-5 grid grid-cols-2 gap-2 text-blue-400 font-medium">
                                <li>HTML & CSS</li>
                                <li>JavaScript / TypeScript</li>
                                <li>React.js</li>
                                <li>Tailwind CSS</li>
                                <li>Node.js</li>
                                <li>PHP & Laravel</li>
                                <li>Bancos de dados SQL</li>
                                <li>APIs RESTful</li>
                                <li>Git e GitHub</li>
                                <li>Docker & DevOps</li>
                            </ul>
                        </div>
                        <div class="rounded-xl overflow-hidden border border-gray-800 shadow-lg">
                            <img src="{{ asset('assets/1.png') }}" alt="Vicente" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="projects" class="mb-32 pt-16">
            <div class="reveal">
                <div class="flex justify-between items-end mb-8">
                    <h2 class="text-4xl font-bold">Projetos em Destaque</h2>
                    <a href="{{ route('site.projects') }}" class="text-blue-500 hover:text-blue-400 font-medium hidden sm:block">Ver todos &rarr;</a>
                </div>

                @if($featuredProjects->count() > 0)
                    <div class="relative w-full overflow-hidden rounded-xl bg-gray-900/50 p-2 border border-gray-800" id="carousel-container">
                        
                        <div class="flex transition-transform duration-500 ease-in-out" id="carousel-track">
                            @foreach($featuredProjects as $project)
                                <div class="w-full flex-shrink-0 px-2 lg:px-4">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">
                                        <div class="rounded-lg overflow-hidden border border-gray-800 shadow-md h-64 lg:h-96">
                                            @if($project->cover_image)
                                                <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gray-800 flex items-center justify-center text-gray-500">Sem Imagem</div>
                                            @endif
                                        </div>
                                        <div class="p-6 bg-gray-900 rounded-xl border border-gray-800 flex flex-col justify-center min-h-[250px]">
                                            <h3 class="text-2xl font-bold mb-4 text-white">{{ $project->title }}</h3>
                                            <p class="text-gray-300 text-justify mb-6 line-clamp-4">
                                                {{ $project->summary }}
                                            </p>
                                            <div class="mt-auto">
                                                <a href="{{ route('site.project.details', $project->slug) }}" class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 px-6 py-2.5 rounded-xl transition-colors font-semibold text-white">
                                                    Ver Detalhes do Projeto
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($featuredProjects->count() > 1)
                            <button id="prevBtn" class="absolute top-1/2 left-2 sm:left-6 -translate-y-1/2 bg-black/70 text-white p-3 rounded-full hover:bg-blue-500 transition-colors z-10 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M10 12.796V3.204L4.519 8zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753"/></svg>
                            </button>
                            <button id="nextBtn" class="absolute top-1/2 right-2 sm:right-6 -translate-y-1/2 bg-black/70 text-white p-3 rounded-full hover:bg-blue-500 transition-colors z-10 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M6 12.796V3.204L11.481 8zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753"/></svg>
                            </button>

                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
                                @foreach($featuredProjects as $index => $project)
                                    <button class="carousel-dot w-3 h-3 rounded-full bg-gray-500 hover:bg-white transition-colors" data-index="{{ $index }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="p-10 bg-gray-900 rounded-xl border border-gray-800 text-center text-gray-500">
                        Nenhum projeto em destaque no momento.
                    </div>
                @endif
                
                <div class="mt-6 text-center sm:hidden">
                    <a href="{{ route('site.projects') }}" class="text-blue-500 font-medium inline-block py-2">Ver todos os projetos &rarr;</a>
                </div>
            </div>
        </section>

        <section class="py-10">
            <div class="reveal">
                <h2 class="text-3xl font-bold mb-6">Quer ver mais código?</h2>
                <div class="p-8 md:p-12 bg-gray-900 rounded-xl border border-gray-800 shadow-xl flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-white mb-3">É aqui que a mágica acontece</h3>
                        <p class="text-gray-300 text-justify">
                            No meu GitHub você encontra inúmeros projetos que vão do frontend ao backend. Desde projetos mais simples e diretos, feitos com HTML, CSS e JavaScript, a projetos mais elaborados construídos com React, Tailwind, sistemas de roteamento, e backends feitos com Laravel, Node.js, bancos de dados SQL, autenticação e muito mais.
                        </p>
                    </div>
                    <div>
                        <a href="https://github.com/VicenteAlef" target="_blank" class="flex items-center gap-3 bg-white text-black hover:bg-gray-200 px-8 py-4 rounded-xl font-bold transition-colors whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/></svg>
                            Visitar Perfil no GitHub
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if($featuredProjects->count() > 1)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('carousel-track');
            const slides = track.children;
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const dots = document.querySelectorAll('.carousel-dot');
            
            let currentIndex = 0;
            const slideCount = slides.length;
            let autoPlayInterval;

            const updateCarousel = () => {
                track.style.transform = `translateX(-${currentIndex * 100}%)`;
                
                // Atualizar os dots
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.remove('bg-gray-500');
                        dot.classList.add('bg-white', 'scale-125');
                    } else {
                        dot.classList.add('bg-gray-500');
                        dot.classList.remove('bg-white', 'scale-125');
                    }
                });
            };

            const nextSlide = () => {
                currentIndex = currentIndex === slideCount - 1 ? 0 : currentIndex + 1;
                updateCarousel();
            };

            const prevSlide = () => {
                currentIndex = currentIndex === 0 ? slideCount - 1 : currentIndex - 1;
                updateCarousel();
            };

            // Event Listeners
            nextBtn.addEventListener('click', () => { nextSlide(); resetAutoPlay(); });
            prevBtn.addEventListener('click', () => { prevSlide(); resetAutoPlay(); });

            dots.forEach(dot => {
                dot.addEventListener('click', (e) => {
                    currentIndex = parseInt(e.target.dataset.index);
                    updateCarousel();
                    resetAutoPlay();
                });
            });

            // Auto Play a cada 8 segundos
            const startAutoPlay = () => {
                autoPlayInterval = setInterval(nextSlide, 8000);
            };

            const resetAutoPlay = () => {
                clearInterval(autoPlayInterval);
                startAutoPlay();
            };

            // Inicializar
            updateCarousel();
            startAutoPlay();
        });
    </script>
    @endif
@endsection