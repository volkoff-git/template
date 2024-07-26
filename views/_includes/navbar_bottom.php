<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/" >
							<?=LibIcons::i('home', 'nav-link-icon');?><span class="nav-link-title">Лиды</span>
                        </a>
                    </li>

					<? if($this->user['role'] === 'admin'): ?>
					<li class="nav-item">
						<a class="nav-link" href="/admin" >
                            <?=LibIcons::i('gear', 'nav-link-icon');?><span class="nav-link-title">Админка</span>
						</a>
					</li>

					<? endif; ?>

					<li class="nav-item">
						<a class="nav-link" href="/external" >
                            <?=LibIcons::i('gear', 'nav-link-icon');?><span class="nav-link-title">Внешний интерфейс</span>
						</a>
					</li>


                    <li class="nav-item dropdown d-none">
                        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
							<span class="nav-link-icon d-md-none d-lg-inline-block">
							  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
								   stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
								  <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
								  <path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" />
								  <path d="M18.35 5.65l-3.35 3.35" />
							  </svg>
							</span>
                            <span class="nav-link-title">Help</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="https://tabler.io/docs" target="_blank" rel="noopener">
                                list item 1
                            </a>
                            <a class="dropdown-item" href="./changelog.html">
                                list item 2
                            </a>
                            <a class="dropdown-item" href="https://github.com/tabler/tabler" target="_blank" rel="noopener">
                                list item 3
                            </a>
                            <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm" target="_blank" rel="noopener">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                                list item 4
                            </a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</header>