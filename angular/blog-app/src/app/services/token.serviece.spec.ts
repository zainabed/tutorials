import { TestBed } from '@angular/core/testing';
import { Token } from './token';
import { TokenService } from './token.service';

describe('TokenSerrvice test cases', () => {
  var tokenService: TokenService;
  var tokenTime: number;

  beforeEach(() => {
     TestBed.configureTestingModule({
      providers: [TokenService]
     })
     tokenService = TestBed.inject(TokenService);
  })

  // beforeEach(() => {
  //   tokenService = new TokenService();
  // });

  it('Should return false for expired token', () => {
    tokenTime = Date.now() - 50;
    let token: Token = { timestamp: tokenTime, userId: 1212 };
    let result: boolean = tokenService.isValidToken(token);
    expect(result).toBeFalse();
  });

  it('Should return true for valid token', () => {
    tokenTime = Date.now() + 5000;
    let token: Token = { timestamp: tokenTime, userId: 1212 };
    let result: boolean = tokenService.isValidToken(token);
    expect(result).toBeTrue();
  });
});
