import { validateName } from "./mutation.example";

describe("Mutation test example.", () => {

    it("Should return false for short name.", () => {
        let name = "abc";
        expect(validateName(name)).toBeFalse();
    });

    it("Should return true for correct name.", () => {
        let name = "Benjamin";
        expect(validateName(name)).toBeTrue();
    });

    it("Should return for empty name", ()=>{
        let name = null;
        expect(validateName(name)).toBeFalse();
    });
});
