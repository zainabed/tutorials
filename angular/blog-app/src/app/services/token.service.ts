import { Token } from './token';

export class TokenService {
  isValidToken(token: Token): boolean {
    let currentTime = Date.now();
    let timeDifference: number = token.timestamp - currentTime;
    if (timeDifference < 0) {
      return false;
    } else {
      return true;
    }
  }
}
