import { describe, expect, it } from 'vitest';
import { chanceAverage, validateChanceConfig } from '../bengalbet/services/chanceRewards';

const ok = { spin: [{ label: 'a', amount: 100, weight: 3 }, { label: 'b', amount: 0, weight: 1 }], golden_egg: [], red_envelope: [] };

describe('chance rewards', () => {
  it('rejects a prize above ৳10,000', () => {
    expect(validateChanceConfig({ ...ok, spin: [{ label: 'x', amount: 10001, weight: 1 }] })).not.toBeNull();
  });
  it('rejects a zero weight', () => {
    expect(validateChanceConfig({ ...ok, spin: [{ label: 'x', amount: 5, weight: 0 }] })).not.toBeNull();
  });
  it('accepts a valid table and computes the weighted average', () => {
    expect(validateChanceConfig(ok)).toBeNull();
    expect(chanceAverage(ok.spin)).toBe(75);
  });
});
