import { Component, Input } from '@angular/core';
import { PodcastItem } from '../podcast-item';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-podcast-item',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './podcast-item.component.html',
  styleUrl: './podcast-item.component.css'
})
export class PodcastItemComponent {
  @Input() podcastItem!: PodcastItem;
}
