<template>
	<div class="contacts-list">
		<ul>
			<li 
			v-for="contact in sortedContacts" 
			:key="contact.id" 
			@click="selectContact(contact)" 
			:class="{ 'selected': contact == selected }">
				<div class="avatar">
					<img v-if="contact.profile_image" :src="'http://bit-lottery.com/demo/public/storage/images/' + contact.profile_image" :alt="contact.name">
				</div>
				<div class="contact">
					<p class="name">{{ contact.name }}</p>
					<p class="email">{{ contact.email }}</p>
				</div>
				<span class="unread" v-if="contact.unread">{{contact.unread}}</span>
			</li>
		</ul>
	</div>
</template>

<script>
	export default {
		props: {
			contacts: {
				type: Array,
				default: []
			}
		},
		data() {
			return {
				selected: this.contacts.length ? this.contacts[0] : null
			}
		},
		methods: {
			selectContact(contact) {
				this.selected = contact;

				this.$emit('selected', contact);
			}
		},
		computed: {
			sortedContacts() {
				return _.sortBy(this.contacts, [(contact) => {
					if (contact == this.selected) {
						return Infinity;
					}

					return contact.unread;
				}]).reverse();
			}
		}
	}
</script>

<style lang="scss" scoped>
	.contacts-list {
		flex: 2;
		max-height: 600px;
		overflow-y: scroll;
		border-left: 1px solid rgba(255,255,255,.5);

		ul {
			list-style-type: none;
			padding-left: 0;

			li {
				display: flex;
				padding: 2px;
				// border-bottom: 1px solid #a2a2a2;
				height: 80px;
				position: relative;
				cursor: pointer;
				transition: .3s ease-in-out;
				
				&.selected {
					background-color: rgba(255,255,255,.5);

					p {
						color: #fff;
					}
				}

				.avatar {
					flex: 1;
					display: flex;
					align-items: center;


					img {
						width: 40px;
						border: 3px solid rgba(255,255,255,1);
						border-radius: 50%;
						margin: 0 auto;
					}
				}

				.contact {
					display: flex;
					flex-direction: column;
					justify-content: center;
					flex: 3;
					font-size: 12px;
					overflow: hidden;

					p {
						margin: 0;

						&.name {
							font-weight: bold;
						}
					}
				}

				.unread {
					background: lightgreen;
					display: flex;
					color: #fff;
					position: absolute;
					right: 21px;
					top: 20px;
					font-weight: 700;
					min-width: 20px;
					justify-content: center;
					align-items: center;
					line-height: 20px;
					font-size: 12px;
					padding: 0 4px;
					border-radius: 50%;
				}
			}
		}
	}
</style>