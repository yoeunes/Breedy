<el-aside width="260px" class="main-aside">
	<el-menu
					:router="true"
					default-active="1"
					background-color="#313C54"
					text-color="#CED3D8"
					class="el-menu">
		<el-menu-item index="1" :route="{name: 'dashboard'}">
			<i class="el-icon-document"></i>
			<span>Tableau de bord</span>
		</el-menu-item>
		<el-submenu index="2">
			<template slot="title">
				<i class="el-icon-location"></i>
				<span>Animaux</span>
			</template>
			<el-menu-item index="2-1" :route="{name: 'adoption'}">
				<i class="el-icon-menu"></i>
				Animaux à l’adoption
			</el-menu-item>
			<el-menu-item index="2-2" :route="{name: 'breeding'}">
				<i class="el-icon-menu"></i>
				Animaux à l’élevage
			</el-menu-item>
			<el-menu-item index="2-3" disabled><i class="el-icon-menu"></i>Paires d’élevage</el-menu-item>
		</el-submenu>
		<el-menu-item index="3" disabled>
			<i class="el-icon-menu"></i>
			<span>Clients</span>
		</el-menu-item>
		<el-menu-item index="4" disabled>
			<i class="el-icon-document"></i>
			<span>Carnet d’adresses</span>
		</el-menu-item>
		<el-menu-item index="5" disabled>
			<i class="el-icon-setting"></i>
			<span>Frais d’activité</span>
		</el-menu-item>
		<el-menu-item index="6" disabled>
			<i class="el-icon-setting"></i>
			<span>Liste d’attente</span>
		</el-menu-item>
	</el-menu>
</el-aside>
