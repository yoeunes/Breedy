<!-- NavBar For Authenticated Users -->
<spark-navbar :user="user"
							:teams="teams"
							:current-team="currentTeam"
							:unread-announcements-count="unreadAnnouncementsCount"
							:unread-notifications-count="unreadNotificationsCount"
							inline-template>

	<el-header height="80px" class="el-header--app">
		<nav class="el-navbar">
			<div class="bt-menu-trigger">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<h1 class="el-navbar__title"><span>Breedy</span></h1></h1>
			<!-- Current team -->
			<el-dropdown trigger="click">
				<div class="el-navbar__team">
					<span class="el-navbar__current-team" v-for="team in teams" v-if="user.current_team_id == team.id">
						@{{ team.name }}
						<i class="el-icon-arrow-down el-icon--right"></i>
					</span>
				</div>
				<el-dropdown-menu slot="dropdown">
					<a class="el-dropdown-menu__item"
						 v-for="team in teams"
						 v-if="user.current_team_id == team.id"
						 :href="'/settings/{{ Spark::teamsPrefix() }}/'+ team.id">
						Paramètres de l’élevage
					</a>
					<div v-if="user.teams.length > 1">
						<li class="el-select-group__title el-dropdown-menu__item--divided">Changer d’élevage</li>
						<a class="el-dropdown-menu__item" v-for="team in teams"
							 :href="'/settings/{{ Spark::teamsPrefix() }}/'+ team.id +'/switch'">
							<span v-if="user.current_team_id == team.id">
								<i class="el-icon-check" style="color: #67C23A"></i> @{{ team.name }}
							</span>
							<span v-else>
								@{{ team.name }}
							</span>
						</a>
					</div>
				</el-dropdown-menu>
			</el-dropdown>
			<div class="el-navbar__right">
				<div class="el-navbar__icons">
					{{--<a href="#" class="el-navbar__icons-bloc"><i class="el-icon-search"></i></a>
					<a @click="showNotifications" href="#" class="el-navbar__icons-bloc"><i class="el-icon-bell"></i><span
										v-if="notificationsCount > 0">@{{notificationsCount}}</span></a>
					<a href="#" class="el-navbar__icons-bloc el-navbar__icons-bloc--svg">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
							            
							<defs>
								              
								<filter id="cross-a" width="36px" height="36px" x="-12.5%" y="-6.2%" filterUnits="objectBoundingBox">
									                
									<feOffset dy="1" in="SourceAlpha" result="shadowOffsetOuter1"/>
									                
									<feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation=".5"/>
									                
									<feColorMatrix in="shadowBlurOuter1" result="shadowMatrixOuter1"
																 values="0 0 0 0 0.2553 0 0 0 0 0.291621667 0 0 0 0 0.37 0 0 0 1 0"/>
									                
									<feMerge>
										                  
										<feMergeNode in="shadowMatrixOuter1"/>
										                  
										<feMergeNode in="SourceGraphic"/>
										                
									</feMerge>
									              
								</filter>
								            
							</defs>
							            
							<g fill="#FFF" filter="url(#cross-a)" transform="translate(1 -1)">
								              
								<path d="M6.579 2.042a1.067 1.067 0 0 1 2.133 0V14.91a1.067 1.067 0 0 1-2.133 0V2.042z"/>
								              
								<path d="M14.08 7.409a1.067 1.067 0 0 1 0 2.133H1.212a1.067 1.067 0 1 1 0-2.133H14.08z"/>
								            
							</g>
							          
						</svg>
					</a> --}}
				</div>

				<!-- Dropdown profile -->
				<ul class="el-navbar__profile">
					<el-dropdown trigger="click">
						<div class="el-navbar__profile-info">
							<img :src="user.photo_url" class="dropdown-toggle-image spark-nav-profile-photo">
							<span class="el-navbar__profile-name">@{{ user.name }}<i
												class="el-icon-arrow-down el-icon--right"></i></span>
						</div>
						<el-dropdown-menu slot="dropdown">
							<el-dropdown-item onclick="window.location.href='{{ Route('settings') }}'">Mes paramètres
							</el-dropdown-item>
							@if (Spark::developer(Auth::user()->email))
								<el-dropdown-item divided onclick="window.location.href='/spark/kiosk'">
									{{__('Kiosk')}}
								</el-dropdown-item>
							@endif
							<el-dropdown-item onclick="window.location.href='{{ Route('logout') }}'" class="el-navbar__logout"
																divided>Se déconnecter
							</el-dropdown-item>
						</el-dropdown-menu>
					</el-dropdown>
				</ul>
			</div>
		</nav>
	</el-header>
</spark-navbar>

