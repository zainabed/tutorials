export function validateName(name: string | null): boolean {
    if (name == null || name.length < 4) {
        return false;
    }
    return true;
}