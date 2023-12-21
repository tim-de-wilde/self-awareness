import './bootstrap';

import Alpine from "alpinejs";
import focus from '@alpinejs/focus'

Alpine.plugin(focus)

import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm.js';

import 'livewire-sortable'

Livewire.start()
