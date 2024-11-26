import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PodcastItemComponent } from '../podcast-item/podcast-item.component';
import { PodcastItem } from '../podcast-item';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CommonModule, PodcastItemComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css',
})
export class HomeComponent {
  readonly baseUrl = 'https://angular.dev/assets/images/tutorials/common';
  podcastItem: PodcastItem = {
    id: 1,
    title: 'Angular primeiros passos',
    members: 'Ana, Pedro',
    description: 'Falando sobre redes',
    photo: `${this.baseUrl}/example-house.jpg`,
  };
}
